	<?php  
	require 'config.php';


	// QUESTION SIX !
	$values6 = array(
		'classique' => 'Vous étoutez plutôt de la musique classique',
		'rap' 		=> 'Vous étoutez plutôt du rap',
		'rock' 		=> 'Vous étoutez plutôt du rock',
		'variete' 	=> 'Vous étoutez plutôt de la variété',
		'electro' 	=> 'Vous étoutez plutôt de la musique électronique',
		'latine' 	=> 'Vous étoutez plutôt des musiques latines',
		'pop' 		=> 'Vous étoutez plutôt de la musique pop',

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
		Quel type de musique écoutez-vous ?
		<form action="resultats.php" method="post">
			<?php foreach($values6 as $_key => $_value6): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required type="radio" name="musique" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value6; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>

		</div>
	</body>
	</html>


	