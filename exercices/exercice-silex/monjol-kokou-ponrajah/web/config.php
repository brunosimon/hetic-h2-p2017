<?php

// Error
error_reporting(E_ALL);
ini_set("display_errors",1);

//BDD define
define('DB_HOST','localhost');
define('DB_NAME','exercice-silex-monjol-kokou-ponrajah');
define('DB_USER','root');
define('DB_PASS','root');

//PDO connect
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $pdo->query("SET NAMES 'utf8'");
}
catch (PDOException $e)
{
    echo 'Impossible de se connecter à la base de données.';
}

//Autoload
require_once __DIR__.'/../vendor/autoload.php';


$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//Snippet model class
include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);

//Contact model class
include 'models/contact.class.php';
$contact_model = new Contact_Model($pdo);
