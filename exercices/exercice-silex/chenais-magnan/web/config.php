<?php

	//Permet d'afficher toutes les erreurs quelque soit la config
	error_reporting(E_ALL);
	ini_set("display_errors",1);

	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	define('DB_NAME','exercice-silex-chenais-magnan');

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
	$app['debug'] = false;

	// Twig est une brique que l'on va rajouter à Silex. C'est un moteur de templating que l'on ajoute avec la méthode register. Avec php faire du templating c'était long et chiant. Les moteurs de templating ont été inventés pour ça. Twig qui a été pour bien fonctionner avec Silex permet de faire ça plus simplement. Tous les moteurs de templating ont une syntaxe différente.
	$app->register(new Silex\Provider\TwigServiceProvider(), array(
	    'twig.path' => __DIR__.'/views',
	));

	// Url Generator
	$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

	// Form
	use Silex\Provider\FormServiceProvider;
	$app->register(new Silex\Provider\FormServiceProvider());
	$app->register(new Silex\Provider\ValidatorServiceProvider());
	$app->register(new Silex\Provider\TranslationServiceProvider(), array(
	    'translator.domains' => array(),
	));

	//équivalent à Form
	//$app->register(new Silex\Provider\FormServiceProvider());

	include 'models/bookmarks.class.php';
	$bookmarks_model = new Bookmarks_Model($pdo);

	//Form service






