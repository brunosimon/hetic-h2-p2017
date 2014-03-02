var form = $('#form');
form.find('input[type=submit]').hide();

$(function() {
	$('.answer input').on('click', function(event) {
		form.submit();
	})
});