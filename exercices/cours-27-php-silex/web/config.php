<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

define('DB_HOST','localhost');
define('DB_NAME','hetic-p2017-G2-silex-snippets');
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


require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Form
$app->register(new Silex\Provider\FormServiceProvider());

// Translations (used in form layout)
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

// Validator (used in form)
$app->register(new Silex\Provider\ValidatorServiceProvider());


include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);













