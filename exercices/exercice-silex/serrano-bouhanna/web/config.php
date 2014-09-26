<?php

require_once __DIR__.'/../vendor/autoload.php';

// Configs
define('DB_HOST','localhost');
define('DB_NAME','exercice-silex-serrano-bouhanna');
define('DB_USER','root');
define('DB_PASS','root');

// Pdo
try
{
  $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch (PDOException $e)
{
  die('error');
}

$salt = "698(§)£%*¨%€!76£=+£%";

// Silex
$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Session
$app->register(new Silex\Provider\SessionServiceProvider());

// Models
include 'models/snippets.class.php';
include 'models/users.class.php';
include 'models/contact.class.php';
$snippets_model = new Snippets_Model($pdo);
$users_model = new Users_Model($pdo);
$contact_model = new Contact_Model($pdo);
