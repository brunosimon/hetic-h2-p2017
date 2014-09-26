<?php
require_once __DIR__.'/../vendor/autoload.php';

define('DB_HOST','localhost');
define('DB_USER','root');
define('DB_PASS','root');
define('DB_NAME','exercice-silex-mayet-michay');
define('SITE_NAME', 'Hetic Snippets');

$limit = 6;

$app = new Silex\Application();
$app['debug'] = true;

//Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Doctrine
$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver'   => 'pdo_mysql',
        'host'     => DB_HOST,
        'dbname'   => DB_NAME,
        'user' => DB_USER,
        'password' => DB_PASS
    )
));

// Forms
$app->register(new Silex\Provider\FormServiceProvider());

// Translation
$app->register(new Silex\Provider\TranslationServiceProvider(), array(
    'locale_fallbacks' => array('en'),
));

// Validator
$app->register(new Silex\Provider\ValidatorServiceProvider());

// SwiftMailer
$app->register(new Silex\Provider\SwiftmailerServiceProvider());

// Session
$app->register(new Silex\Provider\SessionServiceProvider());

require_once 'models/snippets.class.php';
require_once 'models/forms.class.php';
require_once 'models/users.class.php';

$snippets_model = new Snippets_Model($app);
$forms_model = new Forms_Model($app);
$users_model = new Users_Model($app);
