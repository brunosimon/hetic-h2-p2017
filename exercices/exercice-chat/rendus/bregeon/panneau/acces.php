<?php
if(isset($_GET['action']) AND isset($_GET['id']) AND $_GET['action'] == "envoi" AND $_GET['id'] != ""){

$ban = "";
	try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
    $req = $bdd->prepare('SELECT * FROM login WHERE id = ?');
    $req->execute(array($_GET['id']));

    while ($donnees = $req->fetch())
    { 
		if($donnees['id'] == $_GET['id']){
		$ban = $donnees['admin'];
		}
		else{}
	}
    $req->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
if($ban == "1"){
$ban = "0";
}
else{
$ban = "1";
}
try
{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
$req3 = $bdd->prepare('UPDATE login SET admin = :up WHERE id = :login');
$req3->execute(array(
	'up' => $ban,
	'login' => $_GET['id']
	));
$req3->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
}
?>
