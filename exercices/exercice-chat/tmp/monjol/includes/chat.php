<?php 
	session_start();
	require 'config.php';

	//GET SESSION pseudo and id
	$pseudo = strip_tags(mysql_real_escape_string(htmlspecialchars($_SESSION['pseudo'])));
	/*$id 	= $_SESSION['id'];*/
	/*$message = [];*/


	//If the user is in DB
	if ($pseudo != '') {

		echo 'Bienvenue sur le chat, '.$pseudo.' !<br/>';


	}
	//If user not in DB
	else{	
		echo 'You should <a href="inscription.php" style="color:red">create an acount</a>';
		return false;
	}

	


		/*function afficher_chat(){
			$messages = $pdo->query('SELECT * FROM messages ORDER BY id DESC');
			foreach ($message as $messages) {
				echo $messages;
			}
		}	
		afficher_chat();*/


?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="../../src/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../src/css/style.css">
</head>
<body>
	<a href="../index.php">Deconexion</a>	<!--!!!!!!!!!!!!!!!!!! DESTROY SESSION !!!!!!!!!!!!!!!!!!!!!!!! -->
	

	<div class="chat"></div>

	<form action="#">
		<input type="textarea" class="message" placeholder="Votre message" autofocus>
		<button type="submit" class="sendMessage">Envoyer</button>
	</form>

	<script type="text/javascript" src="../src/js/jquery.min.js"></script>
	<script type="text/javascript" src="../src/js/script.js"></script>
	
</body>
</html>