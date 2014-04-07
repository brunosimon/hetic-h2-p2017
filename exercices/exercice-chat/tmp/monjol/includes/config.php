<?php 
	error_reporting(E_ALL);
	ini_set("display_errors",1);

	define('DB_HOST', 'localhost');
	define('DB_USER', 'alexandre');
	define('DB_PASS', 'Mulder92');
	define('DB_NAME', 'chat_hetic');
	define('SALT', 'A78eO487EZ8T');


	try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
	}
	catch (PDOException $e)
	{
	    die('error');
	}

	

?>