<?php

	require_once 'config.php';

	error_reporting(E_ALL);
	ini_set("display_errors", 1);


	// Liste des 32 pays qualifiés pour la coupe du monde
	$values = array(
		'algeria' 		=> 'Algeria',
		'cameroon' 		=> 'Cameroon',
		'ivoire' 		=> 'Cote d\'Ivoire',
		'ghana' 		=> 'Ghana',
		'nigeria' 		=> 'Nigeria',
		'australia' 	=> 'Australia',
		'iran' 			=> 'Iran',
		'japan' 		=> 'Japan',
		'korea' 		=> 'Korea Republic',
		'belgium' 		=> 'Belgium',
		'bosnia' 		=> 'Bosnia-Herzegovina',
		'croatia' 		=> 'Croatia',
		'england' 		=> 'England',
		'france' 		=> 'France',
		'germany' 		=> 'Germany',
		'greece' 		=> 'Greece',
		'italy' 		=> 'Italy',
		'netherlands' 	=> 'Netherlands',
		'portugal' 		=> 'Portugal',
		'russia' 		=> 'Russia',
		'spain' 		=> 'Spain',
		'switzerland' 	=> 'Switzerland',
		'costa' 		=> 'Costa Rica',
		'honduras' 		=> 'Honduras',
		'mexico' 		=> 'Mexico',
		'usa' 			=> 'USA',
		'argentina' 	=> 'Argentina',
		'brazil' 		=> 'Brazil',
		'chile' 		=> 'Chile',
		'colombia' 		=> 'Colombia',
		'ecuador' 		=> 'Ecuador',
		'uruguay' 		=> 'Uruguay',
	);
	
	if(!empty($_POST['country']))
		$exec = $pdo->exec('UPDATE users SET country = \''.$_POST["country"].'\' WHERE login = \''.$_COOKIE['login'].'\''); // insertion du choix de l'utilisateur dans la base de données

	// Liste des 12 stades de la coupe du monde
	$stadiums = array(
		'maracana' 		=> 'Maracana',
		'sao' 			=> 'Arena de Sao Paulo',
		'mineirao' 		=> 'Mineirao',
		'brasilia' 		=> 'Estadio Nacional de Brasilia',
		'castelao' 		=> 'Arena Castelao',
		'fonte' 		=> 'Arena Fonte Nova',
		'beira' 		=> 'Estadio Beira-Rio',
		'pernambuco' 	=> 'Arena Pernambuco',
		'amazonia' 		=> 'Arena da Amazonia',
		'pantanal' 		=> 'Arena Pantanal',
		'dunas' 		=> 'Arena das Dunas',
		'baixada' 		=> 'Arena da Baixada',
	);


	foreach($stadiums as $_key => $_stadium):
		if(!empty($_POST[$_key]) && isset($_POST['country'])) {
			$exec = $pdo->exec('UPDATE users SET '.$_key.' = \''.$_POST[$_key].'\' WHERE login = \''.$_COOKIE['login'].'\''); // insertion du choix de l'utilisateur dans la base de données
			header('location:result.php'); // redirection vers une nouvelle page
		}

	endforeach;

	if(isset($_POST['submit'])){
		if(!isset($_POST['country']))
			echo 'Veuillez remplir tous les champs !'; // Si le premier champs du formulaire n'est pas rempli, un message d'erreur s'affiche
	}
	
?>
<!doctype html>
<html lang="en">
<head>
	<title>World Cup 2014</title>
	<link href="../CSS/style_vote.css" rel="stylesheet" type="text/css">
</head>
<body>
	
	<h4>Welcome <a id="log"><?php echo ($_COOKIE['login']); ?></a>, please complete the following poll :</h4> <!-- Utilisation du cookie pour afficher le login -->
	<br /><br />

		<form method="post">
			<div class="teams">
			<h2>Which team will win the next World Cup ?</h2>
					<?php
						$i = 1;

						echo '<h3>Africa :</h3>';

						foreach($values as $_key => $_value){

							// Conditions permettant un retour à la ligne en fonction des continents
							if ($i == 6){
								echo '
								<br /><br />
								<h3>Asia :</h3>
								<label for="'.$_key.'">'.$_value.'</label>
								<input type="radio" name="country" value="'.$_key.'" id="'.$_key.'">';
								
							}
							else if ($i == 10){
								echo '
								<br /><br />
								<h3>Europe :</h3>
								<label for="'.$_key.'">'.$_value.'</label>
								<input type="radio" name="country" value="'.$_key.'" id="'.$_key.'">';
							}
							else if ($i == 23){
								echo '
								<br /><br />
								<h3>North and Central America :</h3>
								<label for="'.$_key.'">'.$_value.'</label>
								<input type="radio" name="country" value="'.$_key.'" id="'.$_key.'">';
							}
							else if ($i == 27){
								echo '
								<br /><br />
								<h3>South America :</h3>
								<label for="'.$_key.'">'.$_value.'</label>
								<input type="radio" name="country" value="'.$_key.'" id="'.$_key.'">';
							}
							else{
								echo '
								<label for="'.$_key.'">'.$_value.'</label>
								<input type="radio" name="country" value="'.$_key.'" id="'.$_key.'">';
							}
							
							$i++;

						}
					?>
		</div>
		
		<br /><br /><br />

		<div class="stadiums">
			<h2>Give a note to all stadiums (Between 1 and 5)</h2>
				<?php foreach($stadiums as $_key => $_stadium): ?>
						<label for="<?php echo $_key; ?>"><?php echo $_stadium; ?></label>
						<input type="number" class="num" step="1" value="1" min="1" max="5" onkeypress="return false;" name="<?php echo $_key; ?>" id="<?php echo $_key; ?>">
						<br/>
				<?php endforeach; ?>
				<br /><input type="submit" class="btn btn-primary btn-block btn-large" name="submit" value="Submit"/>
		</div>
	</form>

</body>
</html>