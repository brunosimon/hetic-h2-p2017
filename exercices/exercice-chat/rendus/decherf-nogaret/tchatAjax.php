<?php
	require_once 'connect.php';
	session_start();
	// Send Messages to DB
	$data = array (
			'pseudo' => $_SESSION['pseudo'],
			'message' => $_POST['message'],
	);

	$prepare = $pdo->prepare('INSERT INTO messages (pseudo,message) VALUES (\''.$data['pseudo'].'\',\''.$data['message'].'\')');
	
	if (isset($_POST['message'])) {
		$prepare->execute();
	}
?>