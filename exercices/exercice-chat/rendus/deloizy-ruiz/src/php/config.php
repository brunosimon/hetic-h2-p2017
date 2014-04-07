<?php 
	session_start();
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	define('DB_HOST', 'localhost');
	define('DB_USER', 'mistruck');
	define('DB_PASS', 'mistruck1993');
	define('DB_NAME', 'chat');

try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
	    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
catch (PDOException $e)
	{
		die('Un problème est survenue!');
	}

	
 ?>