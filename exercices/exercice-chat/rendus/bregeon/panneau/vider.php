<?php
if(isset($_GET['action']) AND isset($_GET['id']) AND $_GET['action'] == "envoi" AND $_GET['id'] == "1"){

	try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	$req4 = $bdd->query('TRUNCATE TABLE message');
	$req4->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}

}
?>
