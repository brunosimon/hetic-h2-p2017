<?php 
	session_start();

	require 'config.php';

	$message = strip_tags(mysql_real_escape_string(htmlspecialchars($_POST['message'])));

	if($message != ''){
		//Assign id user to message
		$prepare = $pdo->prepare('INSERT INTO messages (message, id_user) VALUES (:message, :id_user)');
		$prepare->bindValue(':message', $message);
		$prepare->bindValue(':id_user', $_SESSION['id']);
		$prepare->execute();
	}

?>