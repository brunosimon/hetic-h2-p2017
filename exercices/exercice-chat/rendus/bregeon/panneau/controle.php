<?php
    session_start ();  
    if (isset($_SESSION['login']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) { 
	$admin = "";
	try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
    $req = $bdd->prepare('SELECT pseudo, mdp, admin FROM login WHERE pseudo = ?');
    $req->execute(array($_SESSION['login']));

    while ($donnees = $req->fetch())
    {
		if($donnees['pseudo'] == $_SESSION['login'] && $donnees['admin'] == "1" && $donnees['mdp'] == $_SESSION['pass']){
		$admin = 1;
		}
		else{}
	}
    $req->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
if ($admin == 1){
    ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title>Tchat // Admin</title>
<link rel="stylesheet"
media="screen" type="text/css"
title="style" href="../style.css" />
<link rel="shortcut icon" type="image/x-icon" href="../bulle.png" />
<script type="text/javascript" src="../jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="actu.js"></script>
</head>

<body>
<center>Espace ADMIN</center>
<p>
Liste des utilisateurs:
</p>
<p>
</p>
<div id="liste"></div>


		  <?php
    }
	else{
       echo '<body onLoad="alert(\'Erreur\')">'; 
	   $delai=0; 
	$url='../login.php';
	header("Refresh: $delai;url=$url");
}	
	}
    else { 

       echo '<body onLoad="alert(\'Erreur\')">'; 
	   $delai=0; 
	$url='../login.php';
	header("Refresh: $delai;url=$url");

    }  
?>