$(function(){

	init();

	/* ----------- RESPONSIVE NAV ----------- */

	$('#navMobile').on('click', function(){
		$('.hideContent').fadeIn(100);
		$('#nav').transition({x: '280px'});
	});
	$('.hideContent').on('click', function(){
		$('.hideContent').hide();
		$('#nav').transition({x: '0'});
		$('#nav').transition({marginLeft: '-280px'});
	});

	/* ----------- CATEGORIE SELECT ----------- */

	$('body').on('click', '.category li', function(){

		if(currentPage !== 'home')
			battleList();

		if($(this).attr('class').split(' ')[1] != "active"){

			$('.category li').removeClass('active');
			var activeClass = $(this).attr('class');

			$(this).addClass('active');

			if(activeClass == "grey"){
				console.log('grey');
				$('.content ul.battles li.battle').show();
			}
			else{
				$('.content ul.battles li:not(.'+activeClass+')').hide(function(){
					console.log('pas grey +');
					console.log($('.content ul.battles'));
					$('.content ul.battles li.'+activeClass).show();	
					$('.content ul.battles li.add').show();	
				});
			}

			$('.category li div.select').remove();
			$('.category li a span.icon').removeClass('active');

			$(this).prepend('<div class="select '+activeClass+'"></div>');
			$('a span.icon', this).addClass('active');
			$('.category li div.select').transition({marginLeft : '0'}, function(){
				if($('.hideContent').is(':visible'))
					$('.hideContent').trigger('click');
			});
		}
	});

	/* ----------- SEARCH INPUT ----------- */	

	$('#search input').keypress(function() {
	  var hashtag = $(this).val();
	  if(hashtag.length<=0 || hashtag.charAt(0)!="#"){
	  	$(this).val('#');
	  }
	});

	/* ----------- MESSAGE CLOSE ----------- */

	$('.content').delegate('.messageBar a', 'click', function(){
		$(this).parent().fadeOut(300);
	})

	/* ----------- IS IMAGE ----------- */

	$('.content').delegate('.up', 'click', function(e){

			var url = $(this).prev().val();

			$(this).next().attr('src', url);

		});

	$('.content').delegate('.validForm', 'click', function(e){

		addBattle();

	});

	/* ----------- AJAX ----------- */

	function init(){

		var currentPage;

		$.ajax({
			url:"ajax/session_check.php",
			success:function(data){
				if(data == 0)
					battleList();
				else
					showBattle(data);
			}
		});
	}

	function battleList(){

		currentPage = 'home';

		$('.content').html("<div class='loader'><img src='assets/img/ajax-loader.gif' height=16 alt='Chargement en cours'/> Chargement en cours...</div>");

		$.ajax({
			url:"ajax/battles.php",
			async: false,
			beforeSend:function(){
				$('#battle').fadeOut('slow');
				$('#battle').remove();
			},
			success:function(data){
				$('.content').html(data);
			}
		});
	}

	function showBattle(battleId){

		currentPage = 'battle';

		$.ajax({
			url:"ajax/battle.php",
			type: "GET",
			data: { id : battleId },
			beforeSend:function(){
				$('#battles').fadeOut('slow');
			},
			success:function(data){
				$('.content').hide().html(data).fadeIn('slow');
			}
		});

	}

	function addInterface(){

		currentPage = 'add';

		$.ajax({
			url:"ajax/addInterface.php",
			type: "GET",
			beforeSend:function(){
				$('#battles').fadeOut('slow');
			},
			success:function(data){
				$('.content').hide().html(data).fadeIn('slow');
			}
		});

	}

	function addBattle(){

		$.ajax({
			url:"ajax/addBattle.php",
			type: "POST",
			dataType: 'json',
			data: $('.content form').serialize(),
			success:function(data){
				console.log(data.statut);
				$('.messageBar').show();
				$('.messageBar').addClass(data.statut);
				$('.messageBar p').html(data.message);
			},
			 error: function (request, status, error) {
        alert(request.responseText);
    }
		});

	}

	function addVote(battleId, itemSelect){

		$.ajax({
			url:"ajax/vote.php",
			type: "GET",
			dataType: 'json',
			data: { id : battleId, item : itemSelect },
			success:function(data){
				if(data.statut == "Vote")
				{
					showVote(data.score1, data.score2, itemSelect);
				}
				else
					showBattle(battleId);
			}
		});

	}

	function showVote(score1, score2, itemSelect){
		$('.element[data-name!="'+itemSelect+'"]').fadeTo("fast", 0.4);

		$('#result .score1').html(score1+'%');
		$('#result .score2').html(score2+'%');

		$('#result').fadeIn(500);
	}

	/* ----------- ACTIONS ----------- */

	$('.content').on('click', '.back', function(){
		battleList();
	});

	$('.content').on('click', '#battles a', function(){

		var battleId = $(this).parent().attr('data-id');

		showBattle(battleId);
	});

	$('body').on('click', '.addItem', function(){

		addInterface();

	});

	/* ----------- VOTE ----------- */	

	$('.content').on('click', '.element a', function(){

		var itemSelect = $(this).parent().attr('data-name');
		var battleId = $(this).parent().parent().parent().attr('data-id');

		addVote(battleId, itemSelect);
	});

});













