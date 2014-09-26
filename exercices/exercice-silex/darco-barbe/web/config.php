<?php

define('DB_NAME','exercice-silex-darco-barbe');
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
 $app->register(new Silex\Provider\FormServiceprovider());
 $app->register(new Silex\Provider\ValidatorServiceProvider());
 $app->register(new Silex\Provider\TranslationServiceProvider(), array(
     'translator.domains' => array(),
 ));

include 'models/snippets.class.php';
include 'models/category.class.php';
$snippets_model = new Snippets_Model($pdo);
$category_model = new Category_Model($pdo);
