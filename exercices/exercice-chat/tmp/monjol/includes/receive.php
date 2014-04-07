<?php 
	session_start();

	require 'config.php';

	$messages = array();

	$mess = $pdo->prepare('SELECT * FROM messages ORDER BY id ASC'); // B. : On récupère les message dans l'ordre des ID (pas l'inverse)
	$mess ->execute();
	$return = $mess->fetchAll();


	/*array_push($messages, $afficheMessage);

	$return = array(
		'messages' => $messages
	);*/


	die(json_encode($return));





?>