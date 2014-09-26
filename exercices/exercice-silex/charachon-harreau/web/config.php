<?php

	//Peut être remplacé par E_WARNING, E_PARSE, E_NOTICE, E_ERROR
	error_reporting(E_ALL);
	ini_set("display_errors", 1);

	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_NAME','exercice-silex-charachon-harreau');

	try
	{
	    $pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
	    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED); //renvoit les résultats sous une certaine forme
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

	//Form
	$app->register(new Silex\Provider\FormServiceProvider());
	$app->register(new Silex\Provider\ValidatorServiceProvider());
	$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	    'translator.domains' => array(),
	));

	//Mail
	$app->register(new Silex\Provider\SwiftmailerServiceProvider());

	//
	$app->register(new Silex\Provider\SessionServiceProvider());


	include 'models/snippets.class.php';
	$snippets_model = new Snippets_Model($pdo);



