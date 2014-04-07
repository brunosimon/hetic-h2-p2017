$(function() {
	var formulaire = $('#sender_message');

	// SEND MESSAGE
	formulaire.on('submit', function(){
		var message = $('input[name=message]').val();

		if(!message == ""){
			$.ajax({
				url: 'data/php/send.ajax.php',
				type: 'POST',
				data: {message: message},
			})
			.done(function(data) {
				console.log(data);
				$('input[name=message]').val('');
			});
		}
		else{
			alert('Please enter message');
		}
		return false;
	});

	
	// RECEIVE MESSAGES
	setInterval(function(){
		$.ajax({
			url: 'data/php/receive.ajax.php'
		})
		.done(function(data) {
			$('.messages').html('');
			$('.messages').html(data);
		});
	}, 100);
});