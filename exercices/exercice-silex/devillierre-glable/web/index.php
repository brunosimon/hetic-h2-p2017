<?php
require 'config.php';
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Twig

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));

// Url Generator

$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

//HOME

$app->get('/', function() {
	global $app;
	global $snippets_model;
	$data = array(

		'title'    => 'Home',
        'snippets' => $snippets_model->get(),
        'pages'    => $snippets_model->get_pages(1)
		
	);

    return $app['twig']->render('home.twig',$data);

})
->bind('home');

//ABOUT

$app->get('/about', function() {
	global $app;
	global $snippets_model;
	$data = array(

		'title'    => 'about',
        'snippets' => $snippets_model->get()
		
	);
    return $app['twig']->render('about.twig',$data);

})
->bind('about');

//ALL CATEGORIES

$app->get('/list', function() {
	global $app;
	global $snippets_model;
	$data = array(

		'title'    => 'all categories',
        'snippets' => $snippets_model->get()
		
	);
    return $app['twig']->render('list.twig',$data);

})

->bind('list');

// PAGE CONTACT

$app->match('/contact', function() {
	global $app;
	global $contact_model;

	$data = array(
		'title'    => 'contact page'
	);
	
	if (!empty($_POST))
	{
		$state = $contact_model->insert($_POST);
		if (isset ($state['sent']))
			$data['state_contact'] = $state['sent'];
		else if (isset ($state['wrong_email']))
			$data['state_contact'] = $state['wrong_email'];
	}

    return $app['twig']->render('contact.twig',$data);

})
->bind('contact');

// Pagination

$app->get('/page/{page}', function($page)
{
	// return 'Page ' .$page; 
	global $app;
	global $snippets_model;
	$data = array(
		'title'    => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
        'pages'    => $snippets_model->get_pages($page)
	);
    return $app['twig']->render('page.twig',$data);
})
->assert('page','\d+')
->bind('page');

// Catégories

$app->get('/category/{category}', function($category)
{
	// return 'category ' .$category;

	global $app;
	global $snippets_model;
	$data = array(
	'title'    => 'Category',
    'snippets' => $snippets_model->get_by_category_slug($category)
	);
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+')
->bind('category');


$app->run();

// énoncé du devoir : 
//faire une page listant toutes les catégories cliquables
//une page permettant de soumettre un snippets (formulaire)
//une page about (juste du texte)
//une page de contact (formulaire)
//un minimum de design (utliser un framework tel que bootstrap pour gagner du temps)

