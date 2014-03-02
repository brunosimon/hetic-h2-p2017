<?php 

require 'config.php';

session_start();

if(!isset($_SESSION['currentPage']))
	$_SESSION['currentPage'] = 0;

$_SESSION['lastPage'] = $_SESSION['currentPage'];

?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title>Poll</title>
	<link href='http://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

	<nav id="nav">
		
		<header id="header"><h1 class="logo">Versus</h1></header>

		<ul class="category">
			<li class="grey active"><a href="#"><span class="icon icon-eye active"></span> All</a></li>
			<?php 

			$req = $pdo->prepare('SELECT c.name, c.color, c.picto, COUNT(category) FROM categories c LEFT JOIN battles b ON c.name = b.category GROUP BY c.name');
			$req->execute() or die(print_r($req->errorInfo(), TRUE));

			while($donnees = $req->fetch()): ?>

 			<li class="<?php echo $donnees['color']; ?>"><a href="#"><span class="icon icon-<?php echo $donnees['picto']; ?>"></span> <?php echo $donnees['name']; ?><span class="nbBattle"><?php echo $donnees['COUNT(category)']; ?></span></a></li>
 			
			<?php endwhile; 

			$req->closeCursor(); ?>
		</ul>

	</nav>

	<nav id="navMobile">

		<h1 class="logo">V</h1>
		
		<span class="menuBar red"></span>
		<span class="menuBar orange"></span>
		<span class="menuBar green"></span>

	</nav>
	
	<div id="topBar">

		<div id="search">
				
			<form action="#" method="GET">
				
				<input type="search" placeholder="#Rechercher" name="search" autocomplete="off">

			</form>

		</div>

		<div class="addItem">+</div>

	</div>

	<div class="hideContent"></div>

	<div class="content">

	</div>	
	
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
	<script src="assets/js/jquery.transit.min.js"></script>
	<script src="assets/js/chart.min.js"></script>
	<script src="assets/js/app.js"></script>
</body>
</html>