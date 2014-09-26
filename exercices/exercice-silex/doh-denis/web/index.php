<?php
require_once 'config.php';

// Accueil
$app->get('/', function() {
	global $snippets_model;
	global $app;

	$data = array(
		'title' => 'Home',
		'snippets' => $snippets_model->get(),
		'pages' => $snippets_model->get_pages(1),
	);
	return $app['twig']->render('home.twig',$data);
})
->bind('home');

// Page
$app->get('/page/{page}', function($page) {
	global $snippets_model;
	global $app;

	$data = array(
		'title' => 'Page',
		'snippets' => $snippets_model->get_by_page($page),
		'pages' => $snippets_model->get_pages($page),
	);
	return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

// Category
$app->get('/category/{category}', function($category) {
	global $snippets_model;
	global $app;

	$data = array(
		'title' => 'Category',
		'snippets' => $snippets_model->get_by_category_slug($category),
		'pages' => $snippets_model->get_pages($category),
	);
	return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

//About
$app->get('/about', function() {
	global $snippets_model;
	global $app;

	$data = array(
		'title' => 'About',
	);
	return $app['twig']->render('about.twig',$data);
})
->bind('about');

//Contact
$app->get('/contact', function() {
	global $snippets_model;
	global $app;

	$data = array(
		'title' => 'Contact',
	);
	return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

//Submit
// On utilise "match" pour que ça fonctionne avec les données de formulaires envoyées en POST
$app->match('/submit', function() {
	global $snippets_model;
	global $app;

	$data = array(
		'title' => 'Soumettre',
	);

	if(!empty($_POST))
		$snippets_model->add_snippet($_POST['title'],$_POST['id_category'],$_POST['content']);

	return $app['twig']->render('submit.twig',$data);
})
->bind('submit');

$app->post('/submit', function() {
	global $snippets_model;
	global $app;

	$data = array(
		'category' => $snippets_model->get_categories()
	);

	if(isset($_POST)){
		$snippets_model->add_snippet($_POST['title'],$_POST['id_category'],$_POST['content']);
	}
	return $app['twig']->render('submit.twig',$data);
	});

//Categories
$app->get('/categories', function() {
	global $snippets_model;
	global $app;

	$data = array(
		'title'      => 'Catégories',
		'categories' => $snippets_model->get_categories()
	);
	return $app['twig']->render('categories.twig',$data);
})
->bind('categories');


$app->run();

?>
