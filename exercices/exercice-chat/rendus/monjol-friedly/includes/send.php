<?php 
	session_start();

	require 'config.php';

	$message = strip_tags(htmlspecialchars($_POST['message']));
	$pseudo = $_SESSION['pseudo'];

	if(!empty($message ) && $message != ' '){
		//Get pseudo of message sender
		$get_id  = $pdo->prepare('SELECT login FROM users WHERE login = :pseudo');
		$get_id ->bindValue(':pseudo', $pseudo);
		$get_id ->execute();
		$id_user = $get_id -> fetchAll();

		//Assign id user to message
		$prepare = $pdo->prepare('INSERT INTO messages (message, id_user) VALUES (:message, :id_user)');
		$prepare->bindValue(':message', $message);
		$prepare->bindValue(':id_user', $id_user);
		$prepare->execute();

	}

?>