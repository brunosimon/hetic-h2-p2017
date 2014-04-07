<?php
	session_start();
	require 'config.php';
	// same passwords
	$login = $_SESSION['login'];
	$message=$_POST['message'];

	$mess = $pdo->prepare('INSERT INTO chat(login,message) VALUES (:login,:message)');
	$mess->bindvalue(':login',$login);
	$mess->bindvalue(':message',$message);
	$mess->execute();




?>