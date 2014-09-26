<?php

    error_reporting(E_ALL);
    ini_set('error_reporting', E_ALL);

    define('DB_HOST', 'localhost');
    define('DB_NAME', 'exercice-silex-deloizy-ruiz');
    define('DB_USER', 'root');
    define('DB_PASS', 'root');


    try
    {
        $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
    }
    catch (PDOException $e)
    {
        die('error');
    }

    require_once __DIR__.'/../vendor/autoload.php'; // récupérer le répertoire vendor

    $app = new Silex\Application();
    $app['debug'] = true;

    // Twig
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/views',
    ));

    // Url Generator
    $app->register(new Silex\Provider\UrlGeneratorServiceProvider());

    //FORM

    use Silex\Provider\FormServiceProvider;
    $app->register(new FormServiceProvider());

    $app->register(new Silex\Provider\ValidatorServiceProvider());
    $app->register(new Silex\Provider\TranslationServiceProvider(), array(
        'translator.domains' => array(),
    ));



    include 'models/cake.class.php';
    $cake_model = new Cake_Model($pdo);

 ?>
