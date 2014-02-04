<?php 

define('DB_HOST','localhost');
define('DB_USER','hetic-P2017');
define('DB_PASS','azerty');
define('DB_NAME','hetic-p2017-poll');

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