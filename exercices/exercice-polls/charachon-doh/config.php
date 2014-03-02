<?php

	//Peut être remplacé par E_WARNING, E_PARSE, E_NOTICE, E_ERROR
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);
	
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_NAME','exercice-poll-charachon-doh');

	try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED); //renvoit les résultats sous une certaine forme
	    $pdo->exec("SET CHARACTER SET utf8");
	}
	catch (PDOException $e)
	{
	    die('error');
	}
