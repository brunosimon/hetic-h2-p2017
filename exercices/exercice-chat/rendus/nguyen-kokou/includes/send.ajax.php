<?php
	include ('config.php');

	if(!empty($_POST['message'])){
		$message = htmlentities($_POST['message']);

		$insert = $pdo->prepare("INSERT INTO messages (name, message, `date`) VALUES (:name, :message, NOW())");
		$insert->bindvalue(':name', $_SESSION['login']);
		$insert->bindvalue(':message', $message);
		$insert->execute();
	}
	else{
		echo 'MESSAGE_EMPTY';
	}
?>