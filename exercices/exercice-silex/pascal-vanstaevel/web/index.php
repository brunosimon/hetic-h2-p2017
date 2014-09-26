<?php

require 'config.php';

//Home
$app->get('/', function(Silex\Application $app) {

	global $app; 
	global $snippets_model;	

	$data = array(
		'title' 			=> 'Home',
		'snippets' 			=> $snippets_model->get(),
		'categories_count' 	=> $snippets_model->get_categories(),
		'pages' 			=> $snippets_model->get_pages(1),

	);
	return $app['twig']->render('home.twig',$data); 
})
->bind('home'); 


//About
$app->get('/about', function(Silex\Application $app) {

	global $app; 
	global $snippets_model;	

	$data = array(
		'title' 			=> 'About',
		'snippets' 			=> $snippets_model->get(),
		'categories_count' 	=> $snippets_model->get_categories(),
		'pages' 			=> $snippets_model->get_pages(1),
	);
	return $app['twig']->render('about.twig',$data); 
})
->bind('about'); 


//Contact
$app->match('/contact', function() {

	global $app; 
	global $snippets_model;	
	global $contact_model;	

	if(!empty($_POST))
	{
		$contact_model->add($_POST);

	}

	$data = array(
		'title' 			=> 'Contact',
		'categories_count' 	=> $snippets_model->get_categories(),
	);
	return $app['twig']->render('contact.twig',$data); 
})
->bind('contact_post'); 


//Add snippets
$app->match('/add', function(Silex\Application $app) {

	global $app; 
	global $snippets_model;	

	if(!empty($_POST))
	{
		$snippets_model->add_snippet($_POST);
	}

	$data = array(
		'title' 			=> 'Add snippets',
		'snippets' 			=> $snippets_model->get(),
		'categories_count' 	=> $snippets_model->get_categories(),
	);
	return $app['twig']->render('add_snippets.twig',$data); 
})
->bind('add_snippets_post'); 


//Page
$app->get('/page/{page}', function($page) {

    global $app; 
	global $snippets_model;	

	$data = array(
		'title' 			=> 'Page',
		'snippets' 			=> $snippets_model->get_by_page($page),
		'categories_count' 	=> $snippets_model->get_categories(),
		'pages' 			=> $snippets_model->get_pages($page),
	);
	return $app['twig']->render('page.twig',$data); 
})
->bind('page')
->assert('page', '\d+');//regex



//Category
$app->get('/category/{category}', function($category) {

    global $app; 
	global $snippets_model;	

	$data = array(
		'title' 			=> 'Category',
		'snippets' 			=> $snippets_model->get_by_category_slug($category),
		'categories_count' 	=> $snippets_model->get_categories(),
	);
	return $app['twig']->render('category.twig',$data); 
})
->bind('category')
->assert('category','[a-z0-9-]+'); // regex slug


//Add category
$app->match('/add_category', function(Silex\Application $app) {

	global $app; 
	global $snippets_model;	

	if(!empty($_POST))
	{
		$snippets_model->add_category($_POST);
	}

	$data = array(
		'title' 			=> 'New category',
		'snippets' 			=> $snippets_model->get(),
		'categories_count' 	=> $snippets_model->get_categories(),
	);
	return $app['twig']->render('add_category.twig',$data); 
})
->bind('add_category'); 

$app->run();
