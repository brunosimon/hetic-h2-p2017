<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title> Sondage </title>
		<link rel="stylesheet" href="style.css">
	</head>
<body>

<h1 id="title">Classement par catégorie</h1>

<div class="result">
	<div class="separateur1"></div>
	<div class="separateur2"></div>
	<div class="separateur3"></div>
	<div class="separateur4"></div>

<?php

session_start();

require'config.php';

if(isset($_POST['drama']) && isset($_POST['action']) && isset($_POST['sciencefiction']) && isset($_POST['comedy']) && isset($_POST['fantastic'])){
	$pdo->exec("INSERT INTO `sondageseries` (`ID`, `user`, `type_drama`, `type_action`, `type_sciencefiction`, `type_comedy`, `type_fantastic`) VALUES (NULL, '".$_SESSION['Login']."', '".$_POST['drama']."', '".$_POST['action']."', '".$_POST['sciencefiction']."', '".$_POST['comedy']."', '".$_POST['fantastic']."')");
}

?>

<!-- Par catégories -->	

<div class='column' >	
	<h1> Drame </h1>
		<?php
			foreach($drama as $v){
				$query = $pdo->query('SELECT COUNT(*) FROM sondageseries WHERE type_drama="'.$v.'"');
				$results = $query->fetch();
					echo "<p>".$v." : ".$results["COUNT(*)"]."</p>";
			}
		?>
</div>
	

<div class='column'>	
	<h1> Action </h1>
		<?php
			foreach($action as $v){
				$query = $pdo->query('SELECT COUNT(*) FROM sondageseries WHERE type_action="'.$v.'"');
				$results = $query->fetch();
					echo "<p>".$v." : ".$results["COUNT(*)"]."</p>";
			}
		?>
</div>

<div class='column'>	
	<h1> Science Fiction </h1>		
		<?php
			foreach($sciencefiction as $v){
				$query = $pdo->query('SELECT COUNT(*) FROM sondageseries WHERE type_sciencefiction="'.$v.'"');
				$results = $query->fetch();
					echo "<p>".$v." : ".$results["COUNT(*)"]."</p>";
			}
		?>
</div>

<div class='column'>	
	<h1> Comédie </h1>
		<?php	
			foreach($comedy as $v){
				$query = $pdo->query('SELECT COUNT(*) FROM sondageseries WHERE type_comedy="'.$v.'"');
				$results = $query->fetch();
					echo "<p>".$v." : ".$results["COUNT(*)"]."</p>";
		}
	?>
</div>

<div class='column'>
	<h1> Fantastique </h1>	
		<?php
			foreach($fantastic as $v){
				$query = $pdo->query('SELECT COUNT(*) FROM sondageseries WHERE type_fantastic="'.$v.'"');
				$results = $query->fetch();
					echo "<p>".$v." : ".$results["COUNT(*)"]."</p>";
			}
		?>
</div>

	</div>
	</div>
	</div>
	</div>
</div>

<!-- Par utilisateur -->

<div class="users">
<h1> Choix des sondés </h1>
<?php

$query = $pdo->query('SELECT * FROM sondageseries');
$users = $query->fetchAll();

foreach($users as $v){
	echo "<strong>".$v['user']."</strong>";
	echo " : ".$drama[$v['type_drama']].", ".$action[$v['type_action']].", ".$sciencefiction[$v['type_sciencefiction']].", ".$comedy[$v['type_comedy']].", ".$fantastic[$v['type_fantastic']];
	echo "<br/>";
}
?>

</div>
</body>
</html>