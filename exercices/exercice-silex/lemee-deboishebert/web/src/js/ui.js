$(document).ready(function() {
	$('.hamburger').on('click', function() {
		$(this).toggleClass('open');
		$('.leftBar').toggleClass('open');
	});
	
	$('.leftBar').css({'height': $(document).height()+'px'});
});