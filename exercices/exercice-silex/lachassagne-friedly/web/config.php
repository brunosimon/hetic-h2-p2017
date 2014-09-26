<?php

require_once 'models/snippets.class.php';
require_once 'models/user.class.php';

DEFINE("SALT",'aefezhjg5^$*ùfez');

error_reporting(E_ALL);
ini_set('display_errors',1);

define('DB_HOST','localhost');
define('DB_NAME','exercice-silex-lachassagne-friedly');
define('DB_USER','root');
define('DB_PASS','root');

try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('error');
}

$zip = new ZipArchive();
$snippets_model = new Snippets_Model($pdo);
$user_model = new User_Model($pdo);


?>
