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

//Debug
$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//Form
$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	'translator.domains' => array(),
));

// Models
include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);
