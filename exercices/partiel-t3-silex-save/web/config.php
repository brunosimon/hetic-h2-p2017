<?php

/**
 * DATABASE
 */

// Globals
define('DB_HOST','localhost');
define('DB_NAME','hetic-p2017-partiel-t3-hetic-citations');
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


// Create random contents
// $quotes = array(
//     'Lorem ipsum dolor sit amet',
//     'Consectetur adipisicing elit',
//     'Tenetur, cum reiciendis ea dignissimos nam vitae',
//     'Sed quibusdam aliquam qui asperiores',
//     'Doloremque, iure ut perspiciatis veniam suscipit delectus aperiam',
//     'Temporibus incidunt'
// );

// for($i = 0; $i < 200; $i++)
// {
//     $quote      = $quotes[rand(0,count($quotes)-1)];
//     $id_student = rand(1,268);
//     $data       = '"2014-0'.rand(3,6).'-'.rand(1,29).' '.rand(0,23).':'.rand(0,59).':'.rand(0,59).'"';
//     $pdo->exec('INSERT INTO quotes (id_student,content,created_at) VALUES ('.$id_student.',"'.$quote.'",'.$data.')');
// }
