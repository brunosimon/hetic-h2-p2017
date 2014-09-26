function editor(id, options)
{
    CodeMirror.fromTextArea(id, options);
}

if($('#code').length != 0){
	editor(document.getElementById('code'), {
	    lineNumbers: true
	});
}

if($('#clipboard_text').length != 0){
	editor(document.getElementById('clipboard_text'), {
	    lineNumbers: true,
	    readOnly: true
	});
}

var client = new ZeroClipboard($('.copy'));

client.on('copy', function() {
	$('.copy').text('COPIED');
	$('.copy').removeClass('label-default').addClass('label-success');
	setTimeout(function(){
		$('.copy').text('COPY');
		$('.copy').removeClass('label-success').addClass('label-default');
	}, 1500);
	$('textarea').focus();
});

client.on('aftercopy', function() {
	$('textarea').focus();
});