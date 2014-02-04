<?php

// Affichage des erreurs
error_reporting(E_ALL); 
ini_set("display_errors",1);

// Variable globales permettant de se connecter
define('DB_NAME','hetic-p2017-g2-poll');
define('DB_HOST','localhost');
define('DB_USER','hetic-p2017-g2');
define('DB_PASS','azerty');

try
{
    // Création de PDO
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);

    // On demande à récupérer de simple tableaux
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('error');
}
