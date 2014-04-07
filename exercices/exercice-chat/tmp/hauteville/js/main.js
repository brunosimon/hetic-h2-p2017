$('.color').on("click",function(e){
	e.preventDefault();
	var color = $(this).attr('data');
	$("input[name='color']").val(color);
	$('.color').removeClass('active');
	$(this).addClass('active');
});