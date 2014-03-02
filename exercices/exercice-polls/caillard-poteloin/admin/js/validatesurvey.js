$('.validate-survey').click(function() {
	var self = $(this);
	var id = parseInt($(this).data('id'));
	var action = parseInt($(this).data('action'));
	console.log(id);
	console.log(action);
	var request = $.ajax({
	  url: "validatesurvey.php",
	  type: "POST",
	  data: { 'survey_id': id, 'action': action },
	  dataType: "html"
	});

	request.done(function( msg ) {
		console.log(msg);
		$('#survey-id-'+id).remove();
	});
});