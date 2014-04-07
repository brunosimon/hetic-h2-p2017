<?php

// Gérer la sauvegarde du message ici
// Profitez-en pour vous assurer que le message est bien formaté
require 'config.php';

if(!empty($_POST))
{	
	$login = htmlspecialchars($_POST['login']);
	$password_1 = htmlspecialchars($_POST['password-1']);
	$password_2 = htmlspecialchars($_POST['password-2']);


	// same passwords

	if($password_1 == $password_2){
		$prepare = $pdo-> prepare('INSERT INTO mdp (login,password) VALUES (:login,:password)');
		$prepare->bindValue(':login',$login);
		$prepare->bindValue(':password',hash('sha256',$password_1.SALT));
		$exec = $prepare->execute();

		$_SESSION['login']=$_POST['login'];

		$statement = $pdo->prepare("SELECT id FROM mdp WHERE login = :login");
		$statement->execute(array(':login' => $login));
		$id = $statement->fetch();
		$_SESSION['id']=$id;

		if ($statement->fetchColumn()) {
		    echo 'Cet identifiant est déjà utilisé';
		} else {
			header("Location: login.php");
		}

		// $login = $pdo->prepare("SELECT id FROM mdp WHERE login = :login");
		// $login->execute(array(':login' => $login));
		// $sess_log = $login->fetch();

		// $_SESSION['login']=$sess_log;

	}
	else{
		echo('Les mots de passe sont différents');
	}

}


