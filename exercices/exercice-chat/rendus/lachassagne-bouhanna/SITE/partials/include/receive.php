<?php 	
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);

	require ('config.php');

	if(!empty($_POST['id'])){
		$prepare    = $pdo->prepare('SELECT * FROM messages WHERE chatRoom=:room ORDER BY id DESC');
		$prepare    ->bindValue(':room',$_POST['id']);
		$prepare    ->execute();
		$messages   = $prepare->fetchAll();
		die(json_encode($messages));
	}

?>