<?php 

	require 'config.php';

	// QUESTION UN !
	$values1 = array(
		'oui' 	=> 'Oui',
		'non' 	=> 'Non',
	);

?>
	<!-- Affichage de la question 1 -->
	<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Exercice Sondage</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div class="ennonce">Bienvenue sur notre service de sondage<br />Merci de répondre aux questions suivantes <br />pour nous aider dans nos statistiques concernant <br />les habitudes de transport pour venir à HETIC <br /><br /><br /></div>
		<div class="questions1">
		<div class="titre"><h1>Question 1 :</h1>
		Prenez-vous les transports pour venir à HETIC ?</div>
		<form action="questdeux.php" method="post">
			<?php foreach($values1 as $_key => $_value1): ?>  <!-- en même tps que je récupère la clé je récupère aussi la valeur -->
				<br /><input required class="radio" type="radio" name="bool" value="<?php echo $_key ?>" id="<?php echo $_key; ?>">
				<label for="<?php echo $_key ?>"><?php echo $_value1; ?></label>
			<?php endforeach; ?>
			<br /><input class="submit" type="submit">
		</form>		
		</div>
	</body>
	</html>



