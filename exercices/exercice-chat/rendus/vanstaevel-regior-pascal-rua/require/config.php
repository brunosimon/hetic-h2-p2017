<?php 
	error_reporting(E_ALL);  // display errors
	ini_set("display_errors", 1);

	// connection DB
	define('DB_HOST', 'localhost');
	define('DB_USER', 'root');
	define('DB_PASS', 'root');
	define('DB_NAME', 'exercice-chat-vanstaevel-regior-pascal-rua');
	define('SALT'	, 'kjhcakj');

	// initialization PDO
	try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
	}
	catch (PDOException $e)
	{
	    die('error');
	}

 ?>