<?php 
	define('DB_NAME', 'exercice-chat-deverriere');
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');	
	try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
	}
	catch (PDOException $e)
	{
	    die('error');
	}

 ?>
