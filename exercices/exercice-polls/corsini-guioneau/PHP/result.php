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


	// ____________ Selection des pays ayant des votes _____________
	$query = $pdo->query('SELECT country FROM users');
	$votes = $query->fetchAll();
	$results = array();

	foreach($votes as $_vote){
		$name = $_vote['country'];

		if(empty($results[$name]))
			$results[$name] = 0;

		$results[$name]++;
	}

	arsort($results);


	// ____________ Selection du pays voté par l'utilisateur _____________
    $query2 = $pdo->query('SELECT country FROM users WHERE login = \''.$_COOKIE['login'].'\'');
	$votes2 = $query2->fetchAll();
	$results2 = array();

	foreach($votes2 as $_vote2){
		$votes2[0] = $_vote2['country'];
	}

	// ____________ Selection des pays ayant des votes _____________
	$k = 0;
	$nb_total = 0;

	foreach($results as $cle=>$valeur) 
    {
    	foreach($values as $cle2=>$valeur2)
    	{
    		if($cle == $cle2){ // Condition pour afficher le vrai nom des équipes et récupérer le nombre de votes 
    			$country[$k] = $valeur2;
    			$nb_votes[$k] = $valeur;

    			if($cle == $votes2[0]){ // Pays choisi par l'utilisateur et son nombre de vote
    				$country_user = $valeur2;
    				$nb_user = $valeur;
    			}

    			$k++;
    		}
    	}

    	$nb_total = $nb_total + $valeur;
    }

    // _________ Poucentage des équipes __________________
    $stade_top1 = round(($nb_votes[0]*100)/$nb_total,2);
    $stade_top2 = round(($nb_votes[1]*100)/$nb_total,2);
    $stade_top3 = round(($nb_votes[2]*100)/$nb_total,2);
    $stade_user = round(($nb_user*100)/$nb_total,2);


	// Liste des 12 stades

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

	$moy = array();
	$notes = array();
	$i=0;
	$j=0;

	foreach($stadiums as $_key => $_stadium):

		$query3 = $pdo->query('SELECT ROUND(AVG('.$_key.'),2) FROM users'); // Note moyenne par stade
		$moyennes = $query3->fetchAll();

		foreach($moyennes as $_moyenne){
			$moy[$i] = $_moyenne['ROUND(AVG('.$_key.'),2)'];
		}

		$query4 = $pdo->query('SELECT '.$_key.' FROM users WHERE login = \''.$_COOKIE['login'].'\''); // Note de l'utilisateur par stade
		$stades = $query4->fetchAll();

		foreach($stades as $_stade){
			$notes[$j] = $_stade[$_key];
		}

		$i++;
		$j++;

	endforeach;

?>
<!doctype html>
<html lang="en">
<head>
	<title>World Cup 2014</title>
	<link href="../CSS/style_vote.css" rel="stylesheet" type="text/css">
</head>
<body>

	<h4>Thank you <a id="log"><?php echo ($_COOKIE['login']); ?></a> for your vote, now discover the results :</h4>

	<h2>Best teams</h2>

	<ul class="bar-graph">
	  <li>
	    <p>Favorite team : <a id="log"><?php print_r($country[0]); ?></a></p>
	    <div class="bar-wrap"><span class="bar-fill" style=<?php print_r("width:".$stade_top1."%;") ?>></span></div>
	    <p>Number of votes : <a id="log"><?php print_r($nb_votes[0].' ('.$stade_top1.'%)'); ?></a></p>
	  </li> 
	  <li>
	    <p>Second team : <a id="log"><?php print_r($country[1]); ?></a></p>
	    <div class="bar-wrap"><span class="bar-fill" style=<?php print_r("width:".$stade_top2."%;") ?>></span></div>
	    <p>Number of votes : <a id="log"><?php print_r($nb_votes[1].' ('.$stade_top2.'%)'); ?></a></p>
	  </li> 
	  <li>
	    <p>Third team : <a id="log"><?php print_r($country[2]); ?></a></p>
	    <div class="bar-wrap"><span class="bar-fill"  style=<?php print_r("width:".$stade_top3."%;") ?>></span></div>
	    <p>Number of votes : <a id="log"><?php print_r($nb_votes[2].' ('.$stade_top3.'%)'); ?></a></p>
	  </li>
	  <p><br /></p>
	  <li>
	    <p>Your pronostic : <a id="log"><?php print_r($country_user); ?></a></p>
	    <div class="bar-wrap"><span class="bar-fill" style=<?php print_r("width:".$stade_user."%;") ?>></span></div>
	    <p>Number of votes : <a id="log"><?php print_r($nb_user.' ('.$stade_user.'%)'); ?> (%)</a></p>
	  </li> 
	</ul>

	<br />

	<h2>Stadiums</h2>

	<ul>
		<li>
			<a id="log">Maracana</a>
			<br/>Global note : <a id="log"><?php print_r($moy[0]); ?></a>
			/ Your vote : <?php print_r($notes[0]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena de Sao Paulo</a>
			<br/>Global note : <a id="log"><?php print_r($moy[1]); ?></a>
			/ Your vote : <?php print_r($notes[1]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Mineirao</a>
			<br/>Global note : <a id="log"><?php print_r($moy[2]); ?></a>
			/ Your vote : <?php print_r($notes[2]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Estadio Nacional de Brasilia</a>
			<br/>Global note : <a id="log"><?php print_r($moy[3]); ?></a>
			/ Your vote : <?php print_r($notes[3]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena Castelao</a>
			<br/>Global note : <a id="log"><?php print_r($moy[4]); ?></a>
			/ Your vote : <?php print_r($notes[4]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena Fonte Nova</a>
			<br/>Global note : <a id="log"><?php print_r($moy[5]); ?></a>
			/ Your vote : <?php print_r($notes[5]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Estadio Beira-Rio</a>
			<br/>Global note : <a id="log"><?php print_r($moy[6]); ?></a>
			/ Your vote : <?php print_r($notes[6]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena Pernambuco</a>
			<br/>Global note : <a id="log"><?php print_r($moy[7]); ?></a>
			/ Your vote : <?php print_r($notes[7]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena da Amazonia</a>
			<br/>Global note : <a id="log"><?php print_r($moy[8]); ?></a>
			/ Your vote : <?php print_r($notes[8]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena Pantanal</a>
			<br/>Global note : <a id="log"><?php print_r($moy[9]); ?></a>
			/ Your vote : <?php print_r($notes[9]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena das Dunas</a>
			<br/>Global note : <a id="log"><?php print_r($moy[10]); ?></a>
			/ Your vote : <?php print_r($notes[10]); ?>
			<br/><br/>
		</li>
		<li>
			<a id="log">Arena da Baixada</a>
			<br/>Global note : <a id="log"><?php print_r($moy[11]); ?></a>
			/ Your vote : <?php print_r($notes[11]); ?>
			<br/><br/>
		</li>
	</ul>

</body>
</html>