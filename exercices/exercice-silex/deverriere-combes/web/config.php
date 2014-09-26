<?php

error_reporting(E_ALL);
ini_set("display_errors",1);

define('DB_HOST','localhost');
define('DB_NAME','hetic-p2017-silex-snippets');
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
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path'=> __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
// Form

// tentative de mail

$app->register(new Silex\Provider\FormServiceProvider());
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(),array(
	'translator.domains' => array(),
));

$app->register(new Silex\Provider\SwiftmailerServiceProvider());
$app['swiftmailer.options'] = array(
    'host' => 'smtp.gmail.com',
    'port' => '465',
    'username' => 'kikoo.lol.rpz@gmail.com',
    'password' => 'PatriotE',
    'encryption' => 'ssl',
    'auth_mode' => 'login'
);

include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);

