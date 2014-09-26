<?php

// Configs
define('DB_HOST','localhost');
define('DB_NAME','exercice-silex-delaunay-poteloin');
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

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
//$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
// URLgenerator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

$app->register(new Silex\Provider\FormServiceProvider());

$app->register(new Silex\Provider\SwiftmailerServiceProvider());

$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));



// Models
include 'models/snippets.class.php';
include 'models/form.class.php';
$snippets_model = new SnippetsModel($pdo);
$form_model = new FormModel($pdo);

?>
