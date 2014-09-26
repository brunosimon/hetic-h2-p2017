<?php


// Nom de la base de donnée que vous avez créé
define('DB_NAME','exercice-silex-regior-rua');
define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');

// Gestion des erreurs
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

// coeur de l'application, silex
$app = new Silex\Application();

// debug
$app['debug'] = true;


// Twig
//Register, méthode pour rajouter un nouveau service (spécifique à silex)
//Paramètres dans array (chemin des templates, des views)
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));


// Url generator
// Simplifier la création d'URL
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


// Form provider
$app->register(new Silex\Provider\FormServiceProvider());

// Validator provider
$app->register(new Silex\Provider\ValidatorServiceProvider());
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'translator.domains' => array(),
));

//	Mail Provider
$app->register(new Silex\Provider\SwiftmailerServiceProvider());
// Config Mail Service
$app['swiftmailer.options'] = array(
    'host' => 'smtp.gmail.com',
    'port' => '465',
    'username' => 'mailtestsmtp02@gmail.com',
    'password' => 'mailtest02',
    'encryption' => 'ssl',
    'auth_mode' => 'login'
);

include 'models/snippets.class.php';
$snippets_model = new Snippets_Model($pdo);

include 'models/form.class.php';
$form_model = new Form_Model($pdo);
