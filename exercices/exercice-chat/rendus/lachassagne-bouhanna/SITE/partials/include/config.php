<?php 
	error_reporting(E_ALL); 
	ini_set('display_errors', 1);

	define('SALT', '65$4ersfz$654-$fez11');

	$server = array(
			'host' => 'localhost',
			'user' => 'root',
			'password' => 'root',
			'db_name' => 'exercice-chat-lachassagne-bouhanna'
		);
	
		try {
			$pdo = new PDO('mysql:host='.$server['host'].';dbname='.$server['db_name'], $server['user'], $server['password']);
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			$pdo->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAME 'utf8'");
			$pdo->query('SET NAMES "utf8"');
		}
		catch (Exception $e) {
			echo "Error with the connection MYSQL  : ", $e->getMessage();
			die();
		}
?>