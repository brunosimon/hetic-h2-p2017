	<?php  
	require 'config.php';


	// QUESTION DEUX !
	$values = array(
		'1' 	=> '1',
		'2' 	=> '2',
		'3' 	=> '3',
		'4' 	=> '4',
		'5' 	=> '5',
		'plus' 	=> 'plus',

	);

	// Reponse question 1
	if(!empty($_POST['bool']))
	$exec = $pdo->exec('INSERT INTO un (bool) VALUES (\''.$_POST['bool'].'\')');

	$query = $pdo->query('SELECT * FROM un');
	$un = $query->fetchAll();
	$results1 = array();


	if ($_POST['bool'] == 'non')
	{
		echo('<script>document.location="resultats.php";</script>');
	}


	foreach($un as $_uns)
	{
		$bool = $_uns['bool'];

		if(empty($results1[$bool]))
			$results1[$bool] = 0;

		$results1[$bool]++;
	}

	arsort($results1); // pour que les votes soient ranger ds ordre croissant


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
		<h1>Question 2 :</h1>
		Combien de transports différents empruntez vous ?
		<form action="questtrois.php" method="post">
			<?php foreach($values as $_key => $_value): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required type="radio" name="nombre" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>

		</div>
	</body>
	</html>


	