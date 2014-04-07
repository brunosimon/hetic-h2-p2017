<?php
	include('config.php');

	if(!empty($_POST['message']) && !empty($_SESSION['login'])){
		$message = htmlentities($_POST['message']);
		$login = $_SESSION['login'];

		$insert = $pdo->prepare("INSERT INTO messages (author, `text`, `date`) VALUES (:author, :text, NOW())");
		$insert->bindvalue(':author', $login);
		$insert->bindvalue(':text', $message);
		$insert->execute();
    }

?>