<?php  

	require 'config.php';
	require 'connect.php';

	$req = $pdo->prepare('SELECT * FROM messages ORDER BY date LIMIT 100');
	$req->execute();
	$messages = $req->fetchAll();

	$return = array(
		'messages' => $messages
	);

	die(json_encode($return));