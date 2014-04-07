<?php 
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);

	require ('config.php');


	// Test s'il y a des données envoyée en POST
	if(!empty($_POST))
	{
		$message 	= $_POST['message'];
		$room 		= $_POST['room'];
		$senderId 	= $_POST['idSender'];
		$senderLogin 	= $_POST['login'];

		$prepare = $pdo->prepare('INSERT INTO messages (content,chatRoom, senderId,date,login) VALUES (:content,:room,:sender,NOW(),:login)');
		$prepare->bindValue(':content',htmlentities($message),PDO::PARAM_STR);
		$prepare->bindValue(':room',$room,PDO::PARAM_INT);
		$prepare->bindValue(':sender',$senderId,PDO::PARAM_INT);
		$prepare->bindValue(':login',$senderLogin,PDO::PARAM_INT);
		$prepare->execute();
	}

?>