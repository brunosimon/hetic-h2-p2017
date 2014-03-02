function setChart(dataJSON) {

	if ($('#results-chart')) {
		options = {
			segmentShowStroke : true,
			segmentStrokeColor : "#fff",
			segmentStrokeWidth : 1,
			animation : true,
			animationSteps : 40,
			animationEasing : "easeInQuart",
			animateRotate : true,
			animateScale : false,
			onAnimationComplete : null
		}


		var choices = [], values = [];
		var colors = ["#D97041", "#7D4F6D", "#21323D", "#9D9B7F", "#C7604C"];
		for(var key in dataJSON) {
			choices.push(key);
			values.push(dataJSON[key])
		}

		var data = [];

		for (var i=0; i<choices.length; i++) {
			data.push({value: values[i], color: colors[i]});
			$('.legend').append('<span><span></span>'+choices[i].replace(/"/g, "")+': '+values[i]+'</span>');
			$('.legend>span:last-child>span').css('background-color', colors[i]);
		}

		var ctx = $("#results-chart").get(0).getContext("2d");
		var resultsChart = new Chart(ctx).Pie(data, options);
	}
}