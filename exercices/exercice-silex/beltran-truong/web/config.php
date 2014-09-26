<?php

require_once __DIR__.'/../vendor/autoload.php';

// Configs
define('DB_HOST','localhost');
define('DB_NAME','hetic-p2017-silex-snippets');
define('DB_USER','root');
define('DB_PASS','root');

// Pdo
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('error');
}

// Silex
$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array( // enregistreent de brisque : service provider. Silex fonction avec des briques qui ne sont pas activé par default, il faut les activer à la mano
    'twig.path' => __DIR__.'/views',
));

// Url Generator //utilisé avec les bind
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//form
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));

//classe qui va chercher les données
include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);
