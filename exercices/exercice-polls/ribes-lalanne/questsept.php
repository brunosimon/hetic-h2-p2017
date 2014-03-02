	<?php  
	require 'config.php';

	// QUESTION SIX !
	$values7 = array(
		'birds'		=> 'Vous jouez plutôt à Angry Birds',
		'candy' 	=> 'Vous jouez plutôt à Candy Crush',
		'solitaire' => 'Vous jouez plutôt au solitaire',
		'imgmots' 	=> 'Vous jouez plutôt à Images & Mots',
		'temple' 	=> 'Vous jouez plutôt à Temple Run',
		'cut' 		=> 'Vous jouez plutôt à Cut the Rope',
		'autre' 	=> 'Vous jouez à d\'autres jeux',
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
	<!-- Affichage de la question 2 -->
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
		A quel type de jeux jouez-vous ?
		<form action="resultats.php" method="post">
			<?php foreach($values7 as $_key => $_value7): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required type="radio" name="game" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value7; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>

		</div>
	</body>
	</html>


	