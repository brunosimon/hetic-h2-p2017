<?php 
	
	include('config.php');

	// Send message
	// Test s'il y a des données envoyée en POST

	if(!empty($_POST)){

	    $message  = $_POST['message'];
  		$nickname = $_SESSION['nickname'];

 		$prepare = $pdo->prepare("INSERT INTO messages (nickname, message, `date`) VALUES (:nickname, :message, NOW())");
 		$prepare->bindValue(':message', $message);
 		$prepare->bindValue(':nickname', $nickname);		
 		$exec = $prepare->execute(); 		

	
 		if ($exec) {
 			echo 'Message sent!';
 		}
 		  
	}	
	else{
		echo 'MESSAGE_EMPTY';
	}
?>


