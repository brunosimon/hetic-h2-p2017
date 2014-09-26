<?php

/**
 * DATABASE
 */

// Globals
define('DB_HOST','localhost');
define('DB_NAME','nom_de_la_table');
define('DB_USER','root');
define('DB_PASS','root');

// PDO
try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
}
catch (PDOException $e)
{
    die('Couldn\'t connect to database. Try to change settings in config.php');
}



/**
 * SILEX
 */

// Autoload
require_once __DIR__.'/../vendor/autoload.php';

// Init Silex Application
$app = new Silex\Application();
$app['debug'] = true; // Show error details



/**
 * SILEX SERVICE PROVIDERS
 */

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Form
$app->register(new Silex\Provider\FormServiceProvider());

// Translations (used in form)
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

// Validator (used in form)
$app->register(new Silex\Provider\ValidatorServiceProvider());



/**
 * MODELS
 */
include 'models/quotes.class.php';
$quotes_model = new Quotes_Model($pdo);
