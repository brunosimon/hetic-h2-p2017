<?php 
	session_start();
	require 'config.php';

	//GET SESSION pseudo
	$pseudo = $_SESSION['pseudo'];
	
	//If the user is in DB
	if (isset($pseudo)) {

		echo '<h1>Bienvenue sur le chat, '.$pseudo.' !</h1><br/>';

	}
	//If user not in DB
	else{	
		echo 'You should <a href="inscription.php" style="color:red">create an acount</a> :)';
		return false;
	}


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
	
	<a href='logout.php' class='button'>Log Out</a>
	<section class="content col-xs-12">
		<div class="chat"></div>

		<form action="#">
			<input type="textarea" class="message col-xs-6" autofocus>
			<button type="submit" class="sendMessage">Envoyer</button>
		</form>
	</section>

	<?php 

	//If admin connected
	if($_SESSION['pseudo'] == 'alex'){
		echo '<button class="button ban">Ban a user</button>';
	}


	?>
	<script type="text/javascript" src="../src/js/jquery.min.js"></script>
	<script type="text/javascript" src="../src/js/script.js"></script>
	
</body>
</html>