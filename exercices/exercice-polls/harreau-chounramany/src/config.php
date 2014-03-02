<?php 
error_reporting(E_ALL);
ini_set("display_error",1);

define('DB_HOST','localhost');
define('DB_USER','Maltion');
define('DB_PASS', 'matthieu');
define('DB_NAME', 'findfriends');
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{		
    die('error');
}
$query = $pdo->query('SELECT * FROM ff_users');
$users = $query->fetchAll();
?>