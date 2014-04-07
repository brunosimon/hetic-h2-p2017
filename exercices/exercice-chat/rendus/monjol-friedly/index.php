<?php
	session_start();

	require 'includes/config.php';

	//If something send in POST
	if (isset($_POST['login'])) 
	{
		//Get login and password
		$login    = strip_tags(htmlspecialchars($_POST['login']));
		$password = strip_tags(htmlspecialchars($_POST['password']));

		//Select all users
		$prepare = $pdo->prepare('SELECT * FROM users WHERE login = :login');
		$prepare->bindValue(':login', $login);
		$prepare->execute();
		$user    = $prepare->fetch();

		//If user is banned
		if($user['password'] == 'bannedForLife!@!'){
			echo '<h2 class="error">You are banned from the serveur</h2>';
			return false;
		}

		//User not found in DB
		if(empty($user))
		{
			echo '<span class="error">User not found, verify your login and password or <a href="includes/inscription.php">create an acount</a></span>';
		}

		//User found
		else
		{
			//Good password
			if($user['password'] == hash('sha256', $password.SALT))
			{
				//Define session speudo
				$_SESSION['pseudo'] = $login;
				header('Location:includes/chat.php');
			}
			//Bad password
			else
			{
				echo '<span class="error">Wrong password !</span>';
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
	<h1>Login</h1>
	<br/><a href="includes/inscription.php" class="button">Inscription</a>
	<!-- Login form -->
	
	<form action="#" method="POST" class="form col-xs-4">
		<div>
			<input type="text" name="login" id="login" class="col-xs-12">
			<label for="login">Login</label>
		</div>
		<div>
			<input type="password" name="password" id="password" class="col-xs-12">
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