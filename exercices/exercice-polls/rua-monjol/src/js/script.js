$(document).ready(function(){


	$('#intro').submit(function() {

    	var pseudo = $('input[name=pseudo]').val();


    	$.ajax({
    		type: "POST",
    		url: "/poll/includes/submit.php",
    		data: {pseudo: pseudo},
    	})

    	$('.question1').removeClass('hidden');
    	$('.pseudo').addClass('hidden');

    	return false;
	});


	$('#q1').submit(function() {

		var value = $('input[name=name1]:checked').val();
		
		$.ajax({
		   type: "POST",
		   url: "/poll/includes/submit.php",
		   data: {name: value}
		})
		
		

    	$('.question1').addClass('hidden');
    	$('.question2').removeClass('hidden');
    	return false;
	});



	$('#q2').submit(function() {

		var value2 = $('input[name=name2]:checked').val();
		
		$.ajax({
		   type: "POST",
		   url: "/poll/includes/submit.php",
		   data: {name: value2}	
		})

    	$('.question2').addClass('hidden');
    	$('.question3').removeClass('hidden');
    	return false;
	});



	$('#q3').submit(function() {

		var value3 = $('input[name=name3]:checked').val();
		
		$.ajax({
		   type: "POST",
		   url: "/poll/includes/submit.php",
		   data: {name: value3}	
		})

    	$('.question3').addClass('hidden');
    	$('.question4').removeClass('hidden');
    	return false;
	});


	$('#q4').submit(function() {

		var value4 = $('input[name=name4]:checked').val();
		
		$.ajax({
		   type: "POST",
		   url: "/poll/includes/submit.php",
		   data: {name: value4},	
		})

    	$('.question4').addClass('hidden');
    	$('.question5').removeClass('hidden');
    	return false;
	});


	$('#q5').submit(function() {

		var value5 = $('input[name=name5]:checked').val();
		
		$.ajax({
		   type: "POST",
		   url: "/poll/includes/submit.php",
		   data: {name: value5},	
		})

    	$('.question5').addClass('hidden');
    	$('.results').removeClass('hidden');
    	return false;
    	
	});
})