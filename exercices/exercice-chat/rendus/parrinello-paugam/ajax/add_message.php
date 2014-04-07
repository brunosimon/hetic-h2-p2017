<?php
	require('../data/config.php');

	if(!empty($_POST)){

		if(isset($_SESSION['time'])){

			if($_SESSION['time'] < time() - 5){

				if(isset($_SESSION['author'])){
					$author = $_SESSION['author'];
				}
				else{
					$author = htmlspecialchars($_POST['author']);
					$_SESSION['author'] = $author;
				}

				$message = htmlspecialchars($_POST['message']);

				$insert = $db->prepare("INSERT INTO messages (`author`, `text`, `date`, room_id) VALUES (:author, :message, NOW(), :room_id)");
				$insert->bindvalue(':author', $author, PDO::PARAM_STR);
				$insert->bindvalue(':message', $message, PDO::PARAM_STR);
				$insert->bindvalue(':room_id', $_POST['room_id'], PDO::PARAM_INT);
				$insert->execute();

				$_SESSION['time'] = time();
			}
			else{
				echo 'TIME_ERROR';
			}	
		}
		else{
			$_SESSION['time'] = time();

			if(isset($_SESSION['author'])){
				$author = $_SESSION['author'];
			}
			else{
				$author = htmlspecialchars($_POST['author']);
				$_SESSION['author'] = $author;
			}

			$message = htmlspecialchars($_POST['message']);

			$insert = $db->prepare("INSERT INTO messages (`author`, `text`, `date`, room_id) VALUES (:author, :message, NOW(), :room_id)");
			$insert->bindvalue(':author', $author, PDO::PARAM_STR);
			$insert->bindvalue(':message', $message, PDO::PARAM_STR);
			$insert->bindvalue(':room_id', $_POST['room_id'], PDO::PARAM_INT);
			$insert->execute();
		}
	}
?>