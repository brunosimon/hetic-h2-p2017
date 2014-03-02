<?php
/* This is the database connection. To find the global variables, go to config.php */
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    $pdo->exec("SET CHARACTER SET utf8");
}
catch (PDOException $e)
{
    die('error');
}