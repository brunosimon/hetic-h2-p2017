<?php

require_once __DIR__.'/../vendor/autoload.php';

// Configs
define('DB_HOST','localhost');
define('DB_NAME','exercice-silex-caillard-peyrot');
define('DB_USER','root');
define('DB_PASS','root');

// Pdo
try {
  $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
  $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_ASSOC);
}
catch (PDOException $e) {
  die('error');
}

$salt ="4az#ff:=5;6egz7=;#8";

// Silex
$app = new Silex\Application();
$app['debug'] = true;

$app->register(new Silex\Provider\TwigServiceProvider(), array(
  'twig.path' => __DIR__.'/views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());

// Models
include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);
include 'models/users.class.php';
$users_model = new Users_Model($pdo);
