<?php

error_reporting(E_ALL);
ini_set('display_errors',1);

define('DB_HOST','localhost');
define('DB_NAME','exercice-silex-menant');
define('DB_USER','root');
define('DB_PASS','root');

try
{
    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
    $pdo->query('SET NAMES utf8');
}
catch (PDOException $e)
{
    echo '<pre>';
    print_r($e->getMessage());
    echo '</pre>';
    exit;
}

require_once 'models/snippets.class.php';
require_once 'models/categories.class.php';
require_once 'models/pages.class.php';
require_once 'models/admins.class.php';

$snippets_model = new Snippets_Model($pdo);
$categories_model = new Categories_Model($pdo);
$pages_model = new Pages_Model($pdo);
$admins_model = new Admins_Model($pdo);

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Validator
$app->register(new Silex\Provider\ValidatorServiceProvider());

// Mail
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$app['swiftmailer.options'] = array(
    'host' => 'smtp.gmail.com',
    'port' => '465',
    'username' => 'testsmtp0101@gmail.com',
    'password' => 'smtp0101',
    'encryption' => 'ssl',
    'auth_mode' => 'login'
);

// Session
$app->register(new Silex\Provider\SessionServiceProvider());
