<?php
	if(isset($_GET['action']) AND $_GET['action'] == "refresh"){
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=exercice-chat-bregeon', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT pseudo, sexe, connecter, admin, mp, blockmp FROM login');
		while ($donees = $req2->fetch())
	    {		
			if ($donees['connecter'] == "1"){
			if ($donees['blockmp'] == "0" && $donees['mp'] == "0"){
			if ($donees['admin'] >= "1"){
			if ($donees['admin'] == "1"){
			echo '<span id="admin">'.$donees['pseudo'].'</span><br />';
			}
			if ($donees['admin'] == "2"){
			echo '<span id="robot">'.$donees['pseudo'].'</span><br />';
			}
			}
			else{
			if ($donees['sexe'] == "homme"){
			echo '<span id="homme">'.$donees['pseudo'].'</span><br />';
			}
			if ($donees['sexe'] == "femme"){
			echo '<span id="femme">'.$donees['pseudo'].'</span><br />';
			}
			}
			}
			else{
			if ($donees['blockmp'] == "1"){
			if ($donees['admin'] >= "1"){
			if ($donees['admin'] == "1"){
			echo '<span id="admin">'.$donees['pseudo'].'</span> <img src="interdit.png" title="Ne reçois pas de MP"/><br />';
			}
			if ($donees['admin'] == "2"){
			echo '<span id="robot">'.$donees['pseudo'].'</span> <img src="interdit.png" title="Ne reçois pas de MP"/><br />';
			}
			}
			else{
			if ($donees['sexe'] == "homme"){
			echo '<span id="homme">'.$donees['pseudo'].'</span> <img src="interdit.png" title="Ne reçois pas de MP"/><br />';
			}
			if ($donees['sexe'] == "femme"){
			echo '<span id="femme">'.$donees['pseudo'].'</span> <img src="interdit.png" title="Ne reçois pas de MP"/><br />';
			}
			}		
			}
			if ($donees['mp'] == "1"){
			if ($donees['admin'] >= "1"){
			if ($donees['admin'] == "1"){
			echo '<span id="admin">'.$donees['pseudo'].'</span> <img src="mp.gif" title="Uniquement en MP"/><br />';
			}
			if ($donees['admin'] == "2"){
			echo '<span id="robot">'.$donees['pseudo'].'</span> <img src="mp.gif" title="Uniquement en MP"/><br />';
			}
			}
			else{
			if ($donees['sexe'] == "homme"){
			echo '<span id="homme">'.$donees['pseudo'].'</span> <img src="mp.gif" title="Uniquement en MP"/><br />';
			}
			if ($donees['sexe'] == "femme"){
			echo '<span id="femme">'.$donees['pseudo'].'</span> <img src="mp.gif" title="Uniquement en MP"/><br />';
			}
			}		
			}
			}
			}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}}
?>