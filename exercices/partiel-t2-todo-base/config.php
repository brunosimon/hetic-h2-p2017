<?php

error_reporting(E_ALL); 
ini_set("display_errors",1);

define('DB_NAME','hetic-p2017-partiel-t2-todo'); // Nom de la base de donnée que vous avez créé
define('DB_HOST','localhost');     // Laissez localhost
define('DB_USER','root');
define('DB_PASS','root');

try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    echo 'Impossible de se connecter à la base de données. Essayez de modifier les valeurs dans config.php.';
}
