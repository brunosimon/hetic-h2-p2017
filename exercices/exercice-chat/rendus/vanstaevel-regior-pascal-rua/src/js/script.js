$(function() {

        // Writing emoticons shortcut to click on the images
        document.getElementById('smiley1').onclick = function(){
            document.getElementById('message').value += ":)"; 
        };
        document.getElementById('smiley2').onclick = function(){
            document.getElementById('message').value += ":D"; 
        };
        document.getElementById('smiley3').onclick = function(){
            document.getElementById('message').value += ":/"; 
        };
        document.getElementById('smiley4').onclick = function(){
            document.getElementById('message').value += ":p"; 
        };
        document.getElementById('smiley4').onclick = function(){
            document.getElementById('message').value += ":("; 
        };
        document.getElementById('smiley6').onclick = function(){
            document.getElementById('message').value += ":o"; 
        };
        document.getElementById('smiley7').onclick = function(){
            document.getElementById('message').value += "(y)"; 
        }; 

        

        // Recuperation form and text field
        var form  = $('#formChat'),
            input = form.find('textarea');

        //Interval repeated every 500 ms which fetch posts
        window.setInterval(function()
        {
        	setTimeout(function(){
        		// Ajax request
	            $.ajax({
	                url      : 'receive.php', 
	                dataType : 'json',       
	                success: function(data){
	                	$('.message-container').html('');
	                	for(var i=data.messages.length-1; i>=0; i--){
		                	$('.message-container').html($('.message-container').html()+'<li class="line-message">'+ '<span class="bold-login">' + data.messages[i].pseudo +'</span>' + ' ' + '<span class="hour"> - ' + data.messages[i].date + ' - </span>' + '</br>' + ' ' + data.messages[i].message + ' ' + '</li>'); // display message in the message frame
	                	}document.getElementById('message-container').scrollTop = 8000; 
	               }
	            });	
        	}, 500);
        },500);
        
        var lemessage = document.getElementById('message');

        // On écoute l'événement submit du formulaire
        form.on('submit',function()
        {
            if(lemessage.value == ""){
                alert('Merci de rentrer un message');
            }
            else{
                $.ajax({
                    url     : 'send.php',               
                    data    : 'message=' + lemessage.value, 
                    type    : 'POST',                 
                    success : function(res)
                    {
                        console.log(res);
                        document.getElementById('message').value = "";
                    }
                });
            }

            return false;

        });

});