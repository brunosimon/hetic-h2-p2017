<?php include('includes/config.php'); ?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>CrazyTweets | Notez les tweets !</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link href="css/style.css" rel="stylesheet">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="css/flat-ui.css" rel="stylesheet">

</head>
<body>
	<div class="container">
		<div class="content">
			<h2 class="main-title">CrazyTweets</h2>
			<div class="row">
				<hr>
				<section class="most_popular">
					<h5>Tweets les plus ... </h5>
					<?php
						foreach($vote_types as $w){
								echo "<a href='#' data-type='".$w."' class='btn btn-lg btn-danger'>".$w."</a> ";
						}
					?>
				</section>
			</div>
			<div class="row">
				<hr>
				<form action="search.php" class="hashtag_search">
					<input type="text" class="hashtag form-control" name="hashtag" value="#">
					<input type="submit" class='btn btn-block btn-lg btn-inverse' value="Rechercher">
				</form>
			</div>
            
			<div class="row">
				<hr>
				<section class="tweets">
					<p>CrazyTweets vous permet de noter les tweets en fonction de l'effet qu'ils vous ont fait. Vous pouvez rechercher des tweets à noter grâce au hashtag, ou afficher le classement des tweets ! À vous de jouer !</p>
				</section>
			</div>
			<div class="row">
				<hr>
				<small>Site crée par <i>Tristan Farneau</i> et <i>Giovanni Xu</i> dans le cadre du cours de développement web à HETIC</small>
			</div>
		</div>
	</div>
	
	<script src="js/main.js"></script>

</body>
</html>