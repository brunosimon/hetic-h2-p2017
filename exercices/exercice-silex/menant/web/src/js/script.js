// Focus on search bar when page on load
var search = document.getElementById('srch');
window.onload = function(){
	search.focus();
}

function editor(id, options)
{
    CodeMirror.fromTextArea(id, options);
}

$(function(){
	$("#edit").YellowText();

	if($('#snippet_add').length != 0){
		editor(document.getElementById('snippet_add'), {
		    lineNumbers: true
		});
	}

	if($('#snippet').length != 0){
		editor(document.getElementById('snippet'), {
		    lineNumbers: true,
		    readOnly: true
		});
	}
});