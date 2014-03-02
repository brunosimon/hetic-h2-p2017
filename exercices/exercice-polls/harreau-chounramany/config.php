<?php 
error_reporting(E_ALL);
ini_set("display_error",1);

define('DB_HOST','mysql51-113.perso');
define('DB_USER','daylidasdev');
define('DB_PASS', 'XcZeBH9hXZfY');
define('DB_NAME', 'daylidasdev');
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
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>