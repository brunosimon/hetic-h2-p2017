$(document).ready(function() {
	// SEND
	$('.form-send').on('submit', function(){
		var message = $('input[name=send]').val();
		if(message == ""){
			alert('Please enter a message');
		}
		else if (message.length < 5){
			alert('Merci de taper 5 caractères minimum.');
		}
		else{
			$.ajax({
				url: 'includes/send.ajax.php',
				type: 'POST',
				data: {message: message}
			})
			.done(function(data) {
				$('.send').val("");
				console.log(data);
			});
		}
		return false;
	});

	// Watch
	if($('.chat').length){ // Little verification, no ajax if login page
		setInterval(function(){
			$.ajax({
				url: 'includes/watch.ajax.php'
			})
			.done(function(data) {
				$('.chat').html("").append(data);
			});
		}, 300);
	}

	// Smiley
	$('.smiley').on('click', function(){
		var shorty = $(this).attr('title');
		$('.send').val($('.send').val() + " " +shorty);
	});
});