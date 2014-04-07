$(document).ready(function() {

	var count = 0;

	// Return ID_ROOM
	function return_id_room (){
		var url = window.location.href,
			split = url.split('=');

		return id = split[2];
	}
	
	// Watch Message
	function watch(){
		$.ajax({
			url: 'ajax/watch_messages.php',
			type: 'POST',
			data: {id: return_id_room()},
		})
		.done(function(data) {
			var messages = data;
			$('.message').html(messages);
		})		
	}

	// Error PopUp
	function error(message){
		$('.tchat').append('<div class="alert alert-danger"><center>'+message+'</center></div>');
		setTimeout(function() {
		    $('.alert').fadeOut();  
		    setTimeout(function(){
		    	$('.alert').remove();
		    }, 3000);
		}, 3000);
	}

	// Send Message
	$('#form').on('submit', function(){
		var message = $('#message').val(),
			author  = $('.author_input #author').val();

		if(message == ""){
			alert('Merci de rentrer un message');
		}
		else if (message < 2){
			alert("Merci de rentrer 2 caractères minimum !");
		}
		else if(author == ""){
			alert('Merci de rentrer un nom pseudo');
		}
		else{
			$.ajax({
				url: 'ajax/add_message.php',
				type: 'POST',
				data: {author: author, message: message, room_id: return_id_room()},
			})
			.done(function(data) {
				if(data == 'TIME_ERROR'){
					error('Vous devez attendre 5 secondes avant de pouvoir envoyer un message');
				}
				else{
					$('.author_input input[name=author]').prop('disabled', true);
					$('#message').val("");
				}
			});
		}
		return false;
	});

	// Smiley
	$('.smiley').on('click', function(){
		var rac = $(this).attr('alt'),
			message = $('#message').val(),
			new_message = message+" "+rac;

		$('#message').val(new_message);
	});

	// Watch Message
	if($('.message').length){
		setInterval(watch, 300);
	}
});