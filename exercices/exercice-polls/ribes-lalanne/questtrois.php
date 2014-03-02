<?php 
	require 'config.php';

// QUESTION TROIS !
	$values3 = array(
		'-1h' 		=> 'Moins d\'une heure',
		'1h' 		=> 'Une heure',
		'1h30' 		=> 'Une heure et demi',
		'2h' 		=> 'Deux heures',
		'2h30' 		=> 'Deux heures et demi',
		'plus2h30' 	=> 'Plus de deux heures et demi',

	);

	// Reponse question 2
	if(!empty($_POST['nombre']))
	$exec = $pdo->exec('INSERT INTO deux (nombre) VALUES (\''.$_POST['nombre'].'\')');

	$query = $pdo->query('SELECT * FROM deux');
	$deux = $query->fetchAll();
	$results = array();

	foreach($deux as $_deuxx)
	{
		$nombre = $_deuxx['nombre'];

		if(empty($results[$nombre]))
			$results[$nombre] = 0;

		$results[$nombre]++;
	}

 ?>
<!-- Affichage de la question 3 -->
 <!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Exercice Sondage</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="questions">
		<h1>Question 3 :</h1>
		Combien d'heures votre trajet dure-t-il ?
		<form action="questquatre.php" method="post">
			<?php foreach($values3 as $_key => $_value3): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required type="radio" name="heure" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value3; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>

		</div>
	</body>
	</html>
