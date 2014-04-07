<?php 
	session_start();
	require_once 'config.php';
	require_once 'connect.php';
	require_once 'functions.php';
	if(!empty($_POST))
	{
		$text = bbcode($_POST['content']);
		$prepare = $pdo->prepare('INSERT INTO messages(pseudo,content,date) VALUES (:pseudo,:content, NOW())');
		$prepare->bindValue(':pseudo',$_SESSION['login']);
		$prepare->bindValue(':content', $text);
		$exec = $prepare->execute(); 
		die('message : '.$_POST['message']);
	}
