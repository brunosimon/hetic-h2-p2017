<?php 

	define('DB_HOST','localhost');
    define('DB_NAME','exercice-chat-darco-barbe');
	define('DB_USER','root');
	define('DB_PASS','root');

// Old school
// $db = mysql_connect(DB_HOST,DB_USER,DB_PASS);
// mysql_select_db(DB_NAME);
// var_dump($db);

// New style
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('error');
}