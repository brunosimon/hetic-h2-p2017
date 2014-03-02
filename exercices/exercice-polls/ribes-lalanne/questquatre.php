<?php 
require 'config.php';

// QUESTION QUATRE !
	$values4 = array(
		'dodo' 		=> 'Vous piquez un petit somme',
		'lecture' 	=> 'Vous lisez',
		'musique' 	=> 'Vous écoutez de la musique',
		'jeux' 		=> 'Vous jouez',
		'blabla' 	=> 'Vous discutez',
		'nothing' 	=> 'Vous ne faites rien',

	);

	// Reponse question 3
	if(!empty($_POST['heure']))
	$exec = $pdo->exec('INSERT INTO trois (heure) VALUES (\''.$_POST['heure'].'\')');

	$query = $pdo->query('SELECT * FROM trois');
	$trois = $query->fetchAll();
	$results3 = array();



	foreach($trois as $_troisx)
	{
		$heure = $_troisx['heure'];

		if(empty($results3[$heure]))
			$results3[$heure] = 0;

		$results3[$heure]++;
	}

?>
<!-- Affichage de la question 4 -->
 <!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Exercice Sondage</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="questions">
		<h1>Question 4 :</h1>
		Comment vous occupez vous dans les transports ?
		<form action="resultats.php" method="post">
			<?php foreach($values4 as $_key => $_value4): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required type="radio" name="occupation" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value4; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>

		</div>
	</body>
	</html>