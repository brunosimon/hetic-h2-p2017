<?php 
	session_start();

	require 'config.php';


	$mess = $pdo->prepare('SELECT * FROM messages ORDER BY id DESC LIMIT 1 '); // B. : On récupère les message dans l'ordre des ID (pas l'inverse)
	$mess ->execute();
	$return = $mess->fetchAll();


	die(json_encode($return));





?>