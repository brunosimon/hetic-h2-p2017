<?php

	include('config.php');
	if(!empty($_POST))
	{
		$pdo->exec('INSERT INTO votes (name) VALUES (\''.$_POST['name'].'\') ');

	}


	$results = array();
	$query = $pdo->query('SELECT * FROM votes');
	$votes = $query->fetchAll();

	foreach ($votes as $_vote) 
	{
		if(empty($results[$_vote['name']])){
			$results[$_vote['name']] = 0;
		}

		$results[$_vote['name']]++;
	}

	arsort($results);					//trie les votes par nombres de choix


	if(isset($pseudo)){
		$pdo->exec('INSERT INTO user (pseudo) VALUES (\''.$_POST['pseudo'].'\') ');
	}


?>