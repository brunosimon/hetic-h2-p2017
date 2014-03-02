$('form').submit(function(event) {
	event.preventDefault ? event.preventDefault() : event.returnValue = false;
	var email = $('#email').val();
	var token = $('#token').val();
	
	$('#email').prop('readonly', true);
	$('#valid').prop('disable', true);
	
	var request = $.ajax({
	  url: "form.php",
	  type: "POST",
	  data: { 'email' : email, 'token' : token },
	  dataType: "html"
	});
	 
	request.done(function( msg ) {
		console.log(msg);
		$('.form-ask').hide();
		
		
		if(msg == 1) {

		}
		
		if(msg == 2) {
		}
		
		if(msg == 3) {
		}
		
		
		$('.form-feedback').html(feedback);
		$('.form-message').fadeIn(500);
	});
	 
	request.fail(function() {
		console.log('An error happened, please try again later.')
	});
});