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
<table>
<tr>
<th>Pseudo</th><th>Sexe</th><th>IP</th><th>Connecter</th><th>Admin</th><th>Bani</th><th>Banir</th><th>Acces</th>
</tr>
<?php
$identiter = 0;
	try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
    $req = $bdd->prepare('SELECT * FROM login');
    $req->execute(array($_SESSION['login']));

    while ($donnees = $req->fetch())
    { 
		$identiter++;
		
		echo'<tr>
		<td>'.$donnees['pseudo'].'</td>
		<td>'.$donnees['sexe'].'</td>
		<td>'.$donnees['ip'].'</td>
		<td>';
		if($donnees['connecter'] == "1"){echo'<img src="bon.png"';}else {{echo'<img src="pasbon.png"';}}
		echo '</td>
		<td>';
		if($donnees['admin'] == "1"){echo'<img src="bon.png"';}else {{echo'<img src="pasbon.png"';}}
		echo '</td><td>';
		if($donnees['bani'] == "1"){echo'<img src="bon.png"';}else {{echo'<img src="pasbon.png"';}}
		echo '</td><td>';
		if($donnees['bani'] == "0"){echo'<input onclick="ban(\''.$donnees['id'].'\')" type="button" value="&nbsp;&nbsp;&nbsp;Banir&nbsp;&nbsp;&nbsp;"/>';}else {{echo'<input onclick="ban(\''.$donnees['id'].'\')" type="button" value="Débanir"/>';}}
		echo '</td><td>';
		if($donnees['admin'] == "0"){echo'<input onclick="acces(\''.$donnees['id'].'\')" type="button" value="Admin"/>';}else {{echo'<input onclick="acces(\''.$donnees['id'].'\')" type="button" value="Users"/>';}}
		echo '</td></tr>';
	}
    $req->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
echo '<div id="monid" style="display:none;">'.$identiter.'</div><div id="myid" style="display:none;"></div>';
?>
</table>
<p><input id="vider" type="button" value="Vider le Tchat" onclick="vider(1);"/></p>
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