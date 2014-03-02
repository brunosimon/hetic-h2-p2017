<?php 
require 'config.php';

// Reponse question 4
	if(!empty($_POST['occupation']))
	$exec = $pdo->exec('INSERT INTO quatre (occupation) VALUES (\''.$_POST['occupation'].'\')');

	$query = $pdo->query('SELECT * FROM quatre');
	$quatre = $query->fetchAll();
	$results4 = array();

	if ($_POST['occupation'] == 'lecture')
	{
		echo('<script>document.location="questcinq.php";</script>');
	}
	if ($_POST['occupation'] == 'musique')
	{
		echo('<script>document.location="questsix.php";</script>');
	}
	if ($_POST['occupation'] == 'jeux')
	{
		echo('<script>document.location="questsept.php";</script>');
	}

	foreach($quatre as $_quatres)
	{
		$occupation = $_quatres['occupation'];

		if(empty($results4[$occupation]))
			$results4[$occupation] = 0;

		$results4[$occupation]++;
	}

	arsort($results4); // pour que les votes soient ranger ds ordre croissant

// Reponse question 5
	if(!empty($_POST['livre']))
	$exec = $pdo->exec('INSERT INTO cinq (livre) VALUES (\''.$_POST['livre'].'\')');

	$query = $pdo->query('SELECT * FROM livre');
	// $cinq = $query->fetchAll();
	$results5 = array();


	// Reponse question 6
	if(!empty($_POST['musique']))
	$exec = $pdo->exec('INSERT INTO six (musique) VALUES (\''.$_POST['musique'].'\')');

	$query = $pdo->query('SELECT * FROM six');
	$six = $query->fetchAll();
	$results6 = array();

	foreach($six as $_sixs)
	{
		$musique = $_sixs['musique'];

		if(empty($results6[$musique]))
			$results6[$musique] = 0;

		$results6[$musique]++;
	}
		

	// Reponse question 7
	if(!empty($_POST['game']))
	$exec = $pdo->exec('INSERT INTO sept (game) VALUES (\''.$_POST['game'].'\')');

	$query = $pdo->query('SELECT * FROM sept');
	$sept = $query->fetchAll();
	$results7 = array();

	foreach($sept as $_septs)
	{
		$game = $_septs['game'];

		if(empty($results7[$game]))
			$results7[$game] = 0;

		$results7[$game]++;
	}


?>

<!doctype html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
	 	<title>Exercice Sondage</title>
	 	<link rel="stylesheet" href="style.css" />
	 </head>
	 <body>
	 <div class="resultsondage">
	 <div class="ennonce">Voici les résultats de notre sondage, <br />Merci de votre participation<br /><br /></div>
<?php

// AFFICHAGE RESULATS QUESTION 1 -------------------------------------------------------------
$truc = $pdo->query('SELECT COUNT(bool) AS numberyes FROM un WHERE bool=\'oui\'');
$result = $truc->fetch();
echo ($result['numberyes'].' personne(s) utilise(nt) les transports en commun <br />');

$truc = $pdo->query('SELECT COUNT(bool) AS numberno FROM un WHERE bool=\'non\'');
$result = $truc->fetch();
echo ($result['numberno'].' personne(s) n\'utilise(nt) pas les transports en commun <br /><br /><br />');



// AFFICHAGE RESULATS QUESTION 2 -------------------------------------------------------------

$truc2 = $pdo->query('SELECT COUNT(nombre) AS t1 FROM deux WHERE nombre=\'1\'');
$results = $truc2->fetch();
echo ($results['t1'].' personne(s) utilise(nt) 1 moyen de transport en commun <br />');

$truc2 = $pdo->query('SELECT COUNT(nombre) AS t2 FROM deux WHERE nombre=\'2\'');
$results = $truc2->fetch();
echo ($results['t2'].' personne(s) n\'utilise(nt) 2 moyens de transports en commun <br />');

$truc2 = $pdo->query('SELECT COUNT(nombre) AS t3 FROM deux WHERE nombre=\'3\'');
$results = $truc2->fetch();
echo ($results['t3'].' personne(s) n\'utilise(nt) 3 moyens de transports en commun <br />');

$truc2 = $pdo->query('SELECT COUNT(nombre) AS t4 FROM deux WHERE nombre=\'4\'');
$results = $truc2->fetch();
echo ($results['t4'].' personne(s) n\'utilise(nt) 4 moyens de transports en commun <br />');

$truc2 = $pdo->query('SELECT COUNT(nombre) AS t5 FROM deux WHERE nombre=\'5\'');
$results = $truc2->fetch();
echo ($results['t5'].' personne(s) n\'utilise(nt) 5 moyens de transports en commun <br />');

$truc2 = $pdo->query('SELECT COUNT(nombre) AS tplus FROM deux WHERE nombre=\'plus\'');
$results = $truc2->fetch();
echo ($results['tplus'].' personne(s) n\'utilise(nt) plus de 5 moyens de transports en commun <br /><br /><br />');



// AFFICHAGE RESULATS QUESTION 3 -------------------------------------------------------------

$truc2 = $pdo->query('SELECT COUNT(heure) AS h1 FROM trois WHERE heure=\'-1h\'');
$results = $truc2->fetch();
echo ($results['h1'].' personne(s) passe(ent) moins d\'une heure dans les transports <br />');

$truc2 = $pdo->query('SELECT COUNT(heure) AS h2 FROM trois WHERE heure=\'1h\'');
$results = $truc2->fetch();
echo ($results['h2'].' personne(s) passe(ent) environ une heure dans les transports <br />');

$truc2 = $pdo->query('SELECT COUNT(heure) AS h3 FROM trois WHERE heure=\'1h30\'');
$results = $truc2->fetch();
echo ($results['h3'].' personne(s) passe(ent) eviron une heure et demi dans les transports <br />');

$truc2 = $pdo->query('SELECT COUNT(heure) AS h4 FROM trois WHERE heure=\'2h\'');
$results = $truc2->fetch();
echo ($results['h4'].' personne(s) passe(ent) eviron deux heures dans les transports <br />');

$truc2 = $pdo->query('SELECT COUNT(heure) AS h5 FROM trois WHERE heure=\'2h30\'');
$results = $truc2->fetch();
echo ($results['h5'].' personne(s) passe(ent) eviron deux heures et demi dans les transports <br />');

$truc2 = $pdo->query('SELECT COUNT(heure) AS h6 FROM trois WHERE heure=\'plus2h30\'');
$results = $truc2->fetch();
echo ($results['h6'].' personne(s) passe(ent) eviron plus de deux heures et demi dans les transports <br /><br /><br />');



// AFFICHAGE RESULATS QUESTION 4 -------------------------------------------------------------

$truc4 = $pdo->query('SELECT COUNT(occupation) AS occup1 FROM quatre WHERE occupation=\'dodo\'');
$results4 = $truc4->fetch();
echo ($results4['occup1'].' personne(s) dorme(nt) dans les transports <br />');

$truc4 = $pdo->query('SELECT COUNT(occupation) AS occup2 FROM quatre WHERE occupation=\'lecture\'');
$results4 = $truc4->fetch();
echo ($results4['occup2'].' personne(s) lise(nt) dans les transports <br />');

$truc4 = $pdo->query('SELECT COUNT(occupation) AS occup3 FROM quatre WHERE occupation=\'musique\'');
$results4 = $truc4->fetch();
echo ($results4['occup3'].' personne(s) écoute(nt) de la musique dans les transports <br />');

$truc4 = $pdo->query('SELECT COUNT(occupation) AS occup4 FROM quatre WHERE occupation=\'jeux\'');
$results4 = $truc4->fetch();
echo ($results4['occup4'].' personne(s) joue(nt) dans les transports <br />');

$truc4 = $pdo->query('SELECT COUNT(occupation) AS occup5 FROM quatre WHERE occupation=\'blabla\'');
$results4 = $truc4->fetch();
echo ($results4['occup5'].' personne(s) discute(nt) dans les transports <br />');

$truc4 = $pdo->query('SELECT COUNT(occupation) AS occup6 FROM quatre WHERE occupation=\'nothing\'');
$results4 = $truc4->fetch();
echo ($results4['occup6'].' personne(s) ne font rien dans les transports <br /><br /><br />');



// AFFICHAGE RESULATS QUESTION 5 -------------------------------------------------------------

$truc5 = $pdo->query('SELECT COUNT(livre) AS bk1 FROM cinq WHERE livre=\'roman\'');
$results5 = $truc5->fetch();
echo ($results5['bk1'].' lise(nt) des romans dans les transports <br />');

$truc5 = $pdo->query('SELECT COUNT(livre) AS bk2 FROM cinq WHERE livre=\'bd\'');
$results5 = $truc5->fetch();
echo ($results5['bk2'].' lise(nt) des BD dans les transports <br />');

$truc5 = $pdo->query('SELECT COUNT(livre) AS bk3 FROM cinq WHERE livre=\'magasine\'');
$results5 = $truc5->fetch();
echo ($results5['bk3'].' lise(nt) des romans dans les transports <br />');

$truc5 = $pdo->query('SELECT COUNT(livre) AS bk4 FROM cinq WHERE livre=\'journal\'');
$results5 = $truc5->fetch();
echo ($results5['bk4'].' lise(nt) des romans dans les transports <br /><br /><br />');



// AFFICHAGE RESULATS QUESTION 6 -------------------------------------------------------------

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq1 FROM six WHERE musique=\'classique\'');
$results6 = $truc6->fetch();
echo ($results6['msq1'].' écoute(nt) de la musique classique dans les transports <br />');

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq2 FROM six WHERE musique=\'rap\'');
$results6 = $truc6->fetch();
echo ($results6['msq2'].' écoute(nt) du rap dans les transports <br />');

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq3 FROM six WHERE musique=\'rock\'');
$results6 = $truc6->fetch();
echo ($results6['msq3'].' écoute(nt) du rock dans les transports <br />');

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq4 FROM six WHERE musique=\'variete\'');
$results6 = $truc6->fetch();
echo ($results6['msq4'].' écoute(nt) de la variété dans les transports <br />');

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq5 FROM six WHERE musique=\'electro\'');
$results6 = $truc6->fetch();
echo ($results6['msq5'].' écoute(nt) de la musique électronique dans les transports <br />');

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq6 FROM six WHERE musique=\'latine\'');
$results6 = $truc6->fetch();
echo ($results6['msq6'].' écoute(nt) de la musique latine dans les transports <br />');

$truc6 = $pdo->query('SELECT COUNT(musique) AS msq7 FROM six WHERE musique=\'pop\'');
$results6 = $truc6->fetch();
echo ($results6['msq7'].' écoute(nt) de la musique pop dans les transports <br /><br /><br />');



// AFFICHAGE RESULATS QUESTION 7 -------------------------------------------------------------

$truc7 = $pdo->query('SELECT COUNT(game) AS jx1 FROM sept WHERE game=\'birds\'');
$results7 = $truc7->fetch();
echo ($results7['jx1'].' joue(nt) à Angry Birds dans les transports <br />');

$truc7 = $pdo->query('SELECT COUNT(game) AS jx2 FROM sept WHERE game=\'candy\'');
$results7 = $truc7->fetch();
echo ($results7['jx2'].' joue(nt) à Candy Crush dans les transports <br />');

$truc7 = $pdo->query('SELECT COUNT(game) AS jx3 FROM sept WHERE game=\'solitaire\'');
$results7 = $truc7->fetch();
echo ($results7['jx3'].' joue(nt) à Angry Birds dans les transports <br />');

$truc7 = $pdo->query('SELECT COUNT(game) AS jx4 FROM sept WHERE game=\'imgmots\'');
$results7 = $truc7->fetch();
echo ($results7['jx4'].' joue(nt) à Angry Birds dans les transports <br />');

$truc7 = $pdo->query('SELECT COUNT(game) AS jx5 FROM sept WHERE game=\'temple\'');
$results7 = $truc7->fetch();
echo ($results7['jx5'].' joue(nt) à Angry Birds dans les transports <br />');

$truc7 = $pdo->query('SELECT COUNT(game) AS jx6 FROM sept WHERE game=\'cut\'');
$results7 = $truc7->fetch();
echo ($results7['jx6'].' joue(nt) à Angry Birds dans les transports <br />');

$truc7 = $pdo->query('SELECT COUNT(game) AS jx7 FROM sept WHERE game=\'autre\'');
$results7 = $truc7->fetch();
echo ($results7['jx7'].' joue(nt) à Angry Birds dans les transports <br />');


?>

	 </div>
	 </body>
	 </html>