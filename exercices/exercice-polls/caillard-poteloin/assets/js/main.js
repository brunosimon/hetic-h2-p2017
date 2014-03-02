$('.add-choice').click(function() {
	if ($('#choice3').css('display') == 'none')
		$('#choice3').css('display', 'block');
	else if ($('#choice4').css('display') == 'none')
		$('#choice4').css('display', 'block');
	else if ($('#choice5').css('display') == 'none') {
		$('#choice5').css('display', 'block');
		$(this).remove();
	}
	else
		$(this).remove();
});