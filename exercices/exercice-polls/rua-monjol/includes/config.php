<?php 
	error_reporting(E_ALL);
	ini_set("display_errors",1);

	if (!defined('DB_HOST')) define('DB_HOST', 'localhost');
	if (!defined('DB_USER')) define('DB_USER', 'root');
	if (!defined('DB_PASS')) define('DB_PASS', 'root');
	if (!defined('DB_NAME')) define('DB_NAME', 'exercice-poll-rua-monjol');


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