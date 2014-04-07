<?php
	session_start();

	require 'includes/config.php';

	//If something send in POST
	if (isset($_POST['login'])) 
	{
		//Get login and password
		$login    = $_POST['login'];
		$password = $_POST['password'];

		//Select all user
		$prepare = $pdo->prepare('SELECT * FROM users WHERE login = :login');
		$prepare->bindValue(':login', $login);
		$prepare->execute();
		$user    = $prepare->fetch();

		//User not found in DB
		if(empty($user))
		{
			echo 'User not found, verify your login and password or <a href="includes/inscription.php">create an acount</a>';
		}

		//User found
		else
		{
			//Good password
			if($user['password'] == hash('sha256', $password.SALT))
			{
				/*$id = $pdo->prepare('SELECT * FROM users WHERE login = :login');
				$id->bindValue(':login', $login);
				$id->execute();*/
				//Define session speudo
				$_SESSION['pseudo'] = $login;
				$_SESSION['id'] 	= '$id';
				header('Location:includes/chat.php');
			}
			//Bad password
			else
			{
				echo 'Wrong password';
			}
		}
		
	}

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="src/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="src/css/style.css">
</head>
<body>
	<br/><a href="includes/inscription.php">Inscription</a>
	<!-- Login form -->
	<form action="#" method="POST">
		<div>
			<input type="text" name="login" id="login">
			<label for="login">Login</label>
		</div>
		<div>
			<input type="password" name="password" id="password">
			<label for="password">Password</label>
		</div>
		<div>
			<input type="submit" value="Valider" name="send">
		</div>
	</form>

	<script type="text/javascript" src="src/js/jquery.min.js"></script>
	<script type="text/javascript" src="src/js/script.js"></script>
</body>
</html>



<!-- TO DO :

Verifier condition premier if dans script.js
session_destroy



 -->