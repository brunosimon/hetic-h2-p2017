    <?php
    session_start ();  
    if (isset($_SESSION['login']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) { 
    ?>
<!DOCTYPE>
<html>
<head>
<title>Tchat // Déconnection</title>
<meta http-equiv="Content-Type"
content="text/html; charset=iso-8859-1"
/>
</head>
<body>
<link rel="stylesheet"
media="screen" type="text/css"
title="style" href="style.css" />

    <?php
try
{
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
$req3 = $bdd->prepare('UPDATE login SET connecter = :up WHERE id = :login');
$req3->execute(array(
	'up' => "0",
	'login' => $_SESSION['id']
	));
$req3->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
	try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	$req4 = $bdd->prepare('DELETE FROM priver WHERE envoyeur = :pseudo');
	$req4->execute(array(
		'pseudo' => $_SESSION['login']
		));
	$req4->closeCursor();
	
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	$req4 = $bdd->prepare('DELETE FROM priver WHERE recepteur = :pseudo');
	$req4->execute(array(
		'pseudo' => $_SESSION['login']
		));
	$req4->closeCursor();
}
catch(Exception $e)
{
    die('Erreur : '.$e->getMessage());
}
    session_start ();   
    session_unset ();      
    session_destroy ();    
    header ('location: login.php');  
    ?> 

 		  <?php
    }  
    else { 

       echo '<body onLoad="alert(\'Erreur\')">'; 
	   $delai=0; 
	$url='login.php';
	header("Refresh: $delai;url=$url");

    }  
    ?>  

</body>
</html>