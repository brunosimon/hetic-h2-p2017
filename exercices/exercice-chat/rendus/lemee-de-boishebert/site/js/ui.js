$(document).ready(function() {

	/*
		Connect form
	*/
	
	/* User Object */
	user = new Object();
	user.latitude = 0;
	user.longitude = 0;
	user.video_auto = 0;
	user.peer_id = 0;
	user.status = 1;
	
	var id_last_message = 0;
	var checkAjax;
	
	var localMediaStream;
	var peer;
	
	$('#geolocationswitch').change(function() {
        if($(this).is(":checked")) {
            if(navigator.geolocation)
			{
				navigator.geolocation.watchPosition(
					function(position)
					{
						$('#geolocationswitch').prop('checked', true);
						user.latitude = position.coords.latitude;
						user.longitude = position.coords.longitude;
					},
					function(error)
					{
						console.log(error.message);
					}
				);

			}
			else
			{
				alert('Geolocation is not supported');
			}
			
			$('#geolocationswitch').prop('checked', false);
        }      
    });
	
	
	navigator.getUserMedia  = navigator.getUserMedia ||
                          navigator.webkitGetUserMedia ||
                          navigator.mozGetUserMedia ||
                          navigator.msGetUserMedia;
						  
	$('#videoswitch').change(function() {
        if($(this).is(":checked")) {
			navigator.getUserMedia({video: true, audio: true}, function(localMediaStream) {
			
			var video = document.querySelector('video');
			var video_me = document.querySelector('.video_me');
			video.src = window.URL.createObjectURL(localMediaStream);
			video_me.src = window.URL.createObjectURL(localMediaStream);

			video.onloadedmetadata = function(e) {
			  // Ready to go. Do some stuff.
			   $('#videoswitch').prop('checked', true);
			   $('.connect video').slideDown('fast');
			   
			   
			   user.video_auto = 1;
			};
		  });
		  
		  $('#videoswitch').prop('checked', false);
		}      
    });
    
    //Create a WebRTC peer for videochat
	peer = new Peer($('.connect form input[name=user_id]').val(), {key: 'zzgn2l06qxv42t9'});
	
	
	// Auto answer to call
	peer.on('call', function(call) {
		console.log('called by');
	    call.answer(localMediaStream);
	    $('.webcams').removeClass('hide');
	});

    
    $('.connect form').submit(function(){
    	$(".connect").fadeOut(function(){
	    	$(".wait").show();
    	});
    	
    	/*
    		Trigger when you submit the connect form
    		Object dataPost send to session.php to create/update account, and create a new session
    	*/
    	
    	var dataPost = {
    		action: "new",
    		lat: user.latitude,
    		long: user.longitude,
    		video_auto: user.video_auto,
    		login: $('.connect form input[name=login]').val(),
    		message: $('.connect form input[name=message]').val()
    	};
    	
    	var jqxhr = $.post('ajax/session.php', dataPost)
		.done(function(data) {
			$(".wait span").text("En attente d'autres utilisateurs...");
		})
		.fail(function() {
			console.log( "error with ajax connection" );
		});
		
		// update last time activity of the session
		var activity = setInterval(function(){
			var dataPost = {
	    		action: "sync"
	    	};
	    	
		    $.post('ajax/session.php', dataPost).done(function(data) {
				//console.log(data);
			});
			
			if(user.status == 1){
				find_peer_ajax();
			}
			
			if(user.status == 2){
				check_message();
			}
			
		}, 2000);
	    return false;
    });
    
    var activity = setInterval(function(){
		if(user.status == 2){
			check_message();
		}
	}, 2000);
	
	$('.clicknext').click(function(){
		next();
		return false;
	});
	
	function next(){
		var dataPost = {
    		action: "next"
    	};
    	
    	user.status = 1;
    	
	    $.post('ajax/chat.php', dataPost).done(function(data) {
	    	//console.log(data);

	    	$(".welcome").show();
	    	$(".chatbox").hide();
		});
		
	}

    
    function find_peer_ajax(){
		var dataPost = {
    		action: "findpeer"
    	};
    	
	    $.post('ajax/session.php', dataPost).done(function(data) {
	    	if(data == "true"){
	    		chat();
	    	}
		});
    }
    

    function add_message(who, text){
    	$('.messages').append($('<div class="line clearfix"><div class="bubble '+who+'"><span class="text">'+text+'</span><span class="time">'+currentTime()+'</span></div></div>').hide().fadeIn());
    	
	    $('.messages').scrollTop(2000000);
    }
    
    function send_message(message){
    	add_message('me', message);
    	
		var dataPost = {
    		action: "send",
    		message: message
    	};
    	
	    $.post('ajax/chat.php', dataPost).done(function(data) {
	    		console.log(data);
		});
    }
    
     $('.inputchat').submit(function(){
		var message = $('.inputchat input[type="text"]').val();
		
		if(message != "")
		{
				$('.inputchat input[type="text"]').val('')
				send_message(message);
		}
		return false;
    });
    
    function check_message(){
	    var dataPost = {
    		action: "check",
    		id_last_message: id_last_message
    	};
    	$( document ).ajaxStop();
    	
	    checkAjax = $.post('ajax/chat.php', dataPost).done(function(data) {
	    	//var result = JSON.parse(data);
	    	if(data == 'disconnected'){
		    	next();
	    	}
	    	else{
		    	var result = JSON.parse(data);
		    	id_last_message = result.new_last_id;
		    	
		    	for(var i= 0; i < result.messages.length; i++)
				{
				     add_message('peer', result.messages[i]);
				}
			}
		});
    }
    
    function chat(){
    	user.status = 2;
		$(".welcome").hide();
		$(".chatbox").show();
		
		//Check if video mode is activated
		
		var dataPost = {
    		action: "video_mode"
    	};
    	
	    checkAjax = $.post('ajax/chat.php', dataPost).done(function(data) {
	    	if(data != 0){
		    	// If the peer has activated video mode, call it
		    	var call = peer.call(data, localMediaStream);
		    	console.log('calling'+data+'by'+peer.id);
	    	}
		});
		
		peerinfos();
    }
    
    function peerinfos(){
		var dataPost = {
    		action: "peerinfos"
    	};
    	
	    checkAjax = $.post('ajax/chat.php', dataPost).done(function(data) {
	    	//console.log(data);
	    	var result = JSON.parse(data);
	    	$('.peer-login').text(result.login);
	    	$('.peer-message').text(result.message);
	    	
	    	if(user.latitude != 0 && user.longitude != 0 && result.latitude != 0 && result.longitude != 0){
		    	var distance = get_distance(user.latitude, user.longitude, result.latitude, result.longitude);
		    	$('.peer-distance').text('('+distance.toFixed(2) + 'km vous séparent)');
	    	}
		});
    }
    
    function currentTime(){
		var d = new Date();
		
		var h = addZero(d.getHours());
		var m = addZero(d.getMinutes());
		return h + ":" + m;
    }
    
    function addZero(i)
	{
		if (i<10) 
		{
			i = "0" + i;
		}
		return i;
	}
	
	function get_distance(lat_1,lon_1,lat_2,lon_2)
	{
	    var radius = 6378.137,
	        d_lat  = (lat_2 - lat_1) * Math.PI / 180,
	        d_lon  = (lon_2 - lon_1) * Math.PI / 180,
	        a      = Math.sin(d_lat/2) * Math.sin(d_lat/2) +
	                 Math.cos(lat_1 * Math.PI / 180) * Math.cos(lat_2 * Math.PI / 180) *
	                 Math.sin(d_lon/2) * Math.sin(d_lon/2),
	        c      = 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a)),
	        d      = radius * c;
	
	    return d; //Meters
	}

    
    
    if(!navigator.cookieEnabled){
	    /* Cookies are needed for security purposes */
	    $('.messageBox').append('<span class="message">Attention : Vous devez autoriser les cookies</span>');
	}
	
});