$(document).ready(function() {

	function RecupForm (name, value){
		if (value == 1){ // INPUT TEXT
			return $('input[name='+name+']').val();
		} else { // INPUT RADIO
			return $('input[name='+name+']:checked').val();
		}
		
	}

	function checkForm(){
		var error = "";
		if (RecupForm('question_1', 1) == ""){
			error += "Question 1 : Vide\n";
		}
		if (RecupForm('question_2', 2) == null){
			error += "Question 2 : Vide\n";
		}
		if (RecupForm('question_3', 2) == null){
			error += "Question 3 : Vide\n";
		}
		if (RecupForm('question_4', 2) == null){
			error += "Question 4 : Vide\n";
		}
		if (RecupForm('question_5', 2) == null){
			error += "Question 5 : Vide\n";
		}
		if (RecupForm('question_6', 2) == null){
			error += "Question 6 : Vide\n";
		}
		if (RecupForm('question_7', 2) == null){
			error += "Question 7 : Vide\n";
		}
		if (RecupForm('question_8', 2) == null){
			error += "Question 8 : Vide\n";
		}
		if (RecupForm('question_7', 2) == null){
			error += "Question 7 : Vide\n";
		}
		if (RecupForm('question_8', 2) == null){
			error += "Question 8 : Vide\n";
		}
		if (RecupForm('question_9', 2) == null){
			error += "Question 9 : Vide\n";
		}
		if (RecupForm('question_10_1', 2) == null){
			error += "Question 10.1 : Vide\n";
		}
		if (RecupForm('question_10_2', 2) == null){
			error += "Question 10.2 : Vide\n";
		}
		if (RecupForm('question_10_3', 2) == null){
			error += "Question 10.3 : Vide\n";
		}
		if (RecupForm('question_11', 2) == null){
			error += "Question 11 : Vide\n";
		}
		if (RecupForm('question_12', 2) == null){
			error += "Question 12 : Vide\n";
		}
		return error;
	}
	$('#questionnaire').change(function(){
		if (checkForm() != ""){
			$('.panel').fadeIn();
			$('.panel-body').html(checkForm());
		}
	});
	$('#questionnaire').submit(function(){
		if (checkForm() != ""){
			return false;
		}
	});
});