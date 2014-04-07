<?php
	session_start();
	require 'config.php';

	if(!empty($_POST))
	{
		$login = htmlspecialchars($_POST['login']);
		$password = htmlspecialchars($_POST['password']);

		$prepare = $pdo -> prepare('SELECT * FROM mdp WHERE login = :login');
		$prepare -> bindValue(':login',$login);
		$prepare -> execute();
		$user = $prepare -> fetch();

		if(empty($user)){
			header("Location: index.php");
		}
		else{
			 if($user['password']== hash('sha256',$password.SALT))
			 {	
			 	$_SESSION['login'] = $login;
			 	header("Location: chat.php");
			 }
			 else 
			 {
			 	echo'Ce n\'est pas le bon mot de Passe';
			 }
		}
	}
?>