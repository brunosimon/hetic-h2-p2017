<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

define('DB_NAME','exercice-silex-pascal-vanstaevel');
define('DB_HOST','localhost');
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

require_once __DIR__.'/../vendor/autoload.php';


$app = new Silex\Application();

$app["debug"]=true;



// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);

include 'models/contact.class.php';
$contact_model = new Contact_Model($pdo);


