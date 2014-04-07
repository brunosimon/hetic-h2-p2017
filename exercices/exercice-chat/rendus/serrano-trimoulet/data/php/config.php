<?php
    session_start();
    ini_set('display_errors', 1);

	// parameters for PDO
    $server = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'db_name' => 'exercice-chat-serrano-trimoulet'
    ];

    try {
        $pdo = new PDO('mysql:host='.$server['host'].';dbname='.$server['db_name'], $server['user'], $server['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->query("SET NAMES 'utf8'");
    }
    catch (Exception $e) {
        echo "Error with the connection MYSQL  : ", $e->getMessage();
        die();
    }
?>