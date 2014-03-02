<?php 

define('DB_HOST','localhost');
define('DB_NAME','hetic-p2017-passwords');
define('DB_USER','root');
define('DB_PASS','root');
define('STATIC_SALT','14FY§!è§sqd');

try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('error');
}