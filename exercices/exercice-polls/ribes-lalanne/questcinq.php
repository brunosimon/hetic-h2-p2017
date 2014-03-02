<?php 
require 'config.php';

// QUESTION CINQ !
	$values5 = array(
		'roman' 	=> 'Vous lisez des romans',
		'bd' 		=> 'Vous lisez des BD',
		'magasine' 	=> 'Vous lisez des magasines',
		'journal' 	=> 'Vous lisez le journal',
	);

// Reponse question 4
	if(!empty($_POST['occupation']))
	$exec = $pdo->exec('INSERT INTO quatre (occupation) VALUES (\''.$_POST['occupation'].'\')');

	$query = $pdo->query('SELECT * FROM quatre');
	$quatre = $query->fetchAll();
	$results4 = array();

	foreach($quatre as $_quatres)
	{
		$occupation = $_quatres['occupation'];

		if(empty($results4[$occupation]))
			$results4[$occupation] = 0;

		$results4[$occupation]++;
	}

?>
<!-- Affichage de la question 5 -->
 <!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Exercice Sondage</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="questions">
		<h1>Question 5 :</h1>
		Quel est votre type de lecture ?
		<form action="resultats.php" method="post">
			<?php foreach($values5 as $_key => $_value5): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required type="radio" name="livre" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value5; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>

		</div>
	</body>
	</html>