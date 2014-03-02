<?php

	// Affichage des erreurs
	error_reporting(E_ALL);
	ini_set('display_errors',1);

	session_start();

	$login = !empty($_SESSION['Login']) ? $_SESSION['Login'] : '';

	// Login Sent
	if(!empty($_POST['login']))
	{
		$login = $_POST['login'];
		$_SESSION['Login'] = $login; 	
	}

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Acceuil sondage</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<div class='accueil'> 
	<p>
		<?php 
			if(!empty($login)){
				echo'Bonjour '.$login.', tu peux maintenant acceder au <a href="poll.php">sondage</a>';
			}else{
				echo 'Veuillez choisir un nom d\'utilisateur 
			<form action="#" method="post">
				<input type="text" name="login" />
				<input type="submit" />';
			}
		?>
	</div>
	</form>
</body>
</html>