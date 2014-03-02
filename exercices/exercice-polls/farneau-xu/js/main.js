// When searching in a specific category
$('.most_popular').delegate("a", "click", function(e){
	// Loader
	$('.tweets').html("<img src='images/pageloader.gif' class='loader' alt='Chargement en cours ...'/>");

	var type = $(this).attr('data-type');
	$.get("ajax/all_tweets.php?limit=10&type="+type, function(data){
		$('.tweets').html(data);
	});
	return false;
});

// When searching a hashtag
$('.hashtag_search').submit(function(e){
	// Loader
	$('.tweets').html("<img src='images/pageloader.gif' class='loader' alt='Chargement en cours ...'/>");

	var hashtag = $('.hashtag').val();
	$.get("ajax/hashtag_search.php?h="+hashtag.substring(1), function(data){
		$('.tweets').html(data);
	});
	
	return false;
});

// When voting
$('.tweets').delegate(".choices a", "click", function(e){
	var action = $(this).attr("data-type");
	var id = $(this).parent().parent().attr('data-id');
	var that = this;
	$.get("ajax/update_count.php?tweet_id="+id+"&vote_type="+action, function(data){
		if(data=="ok"){
			var value = parseInt($(that).find('span.count').text())+1;
			$(that).find('span.count').text(value);
			$(that).css({
				"background-color": '#EC7467'
			});

		}
	});
	return false;
});

// When typing in hashtag form
$("input").keypress(function() {
  var hashtag = $(this).val();
  if(hashtag.length<=0 || hashtag.charAt(0)!="#"){
  	$(this).val('#');
  }
});
