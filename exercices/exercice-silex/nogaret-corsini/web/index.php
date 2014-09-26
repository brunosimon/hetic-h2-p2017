<?php

require 'config.php';
use Symfony\Component\HttpFoundation\Request;

// Home
$app->get('/', function() {
	global $app;
	global $snippets_model;



	$data = array (
		'title' => 'Home',
		'snippets'=> $snippets_model->get(),
		'pages' => $snippets_model->get_pages(1),

	);

    return $app['twig']->render('home.twig',$data);
})
//
->bind('home');

//Page
$app->get('/page/{page}', function($page) {
	global $app;
	global $snippets_model;

    $data = array (
		'title' => 'Page',
		'snippets'=> $snippets_model->get_by_page($page),
		'pages' => $snippets_model->get_pages($page),
	);

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');


//Category
$app->get('/category/{category}', function($category){
    global $app;
    global $snippets_model;

    $data = array (
		'title' => 'Category',
		'snippets'=> $snippets_model->get_by_category_slug($category),
		'pages'   => $snippets_model->get_pages_category(1,$category),
	);

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');


//Category pagination
$app->get('/category/{category}/page/{page}', function($category,$page){
    global $app;
    global $snippets_model;

    $data = array (
		'title'   => 'Category',
		'snippets'=> $snippets_model->get_by_category_slug($category,$page),
		'pages'   => $snippets_model->get_pages_category($page,$category),
	);

    return $app['twig']->render('category.twig',$data);
})
->bind('category_pagination')
->assert('category','[a-z0-9-]+')
->assert('page','\d+');

/**** Contact */
$app->match('/contact', function(Request $request){
	global $app;
	global $snippets_model;

	$form = $app['form.factory']->createBuilder('form')
		->add('name')
		->add('email')
		->add('message', 'textarea')
		->getForm();

	$form->handleRequest($request);

	if ($form->isValid()) {
		$data = $form->getData();
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		$snippets_model->add($data);
		exit;
	}

	$data = array(
		'title' => 'Category',
		'form' => $form->createView()
	);

	return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

/* Send snippets to BDD*/
$app->match('/suggest', function(Request $request){

	global $app;
	global $snippets_model;

	$data = array (
		'title' => 'Add Snippet'
	);

	if($request->getMethod() == 'POST'){
		$form = array (
			'title' => $request->get('name'),
			'category' => $request->get('category'),
			'content' => $request->get('content')
		);

		$snippets_model->add_suggest($form);

		var_dump($form);
	}

	return $app['twig']->render('suggest.twig', $data);
})
->bind('suggest');

/*Get Categories */

$app->get('/categories', function(){
    global $app;
    global $snippets_model;

    $data = array (
		'title' => 'Categories',
		'categories' => $snippets_model->get_categories()
	);

    return $app['twig']->render('categories.twig',$data);
})
->bind('categories')
->assert('category','[a-z0-9-]+');

// About
$app->get('/about', function(){
	global $app;
	global $snippets_model;

	$data = array(
		'title' => 'About'
	);
	return $app['twig']->render('about.twig',$data);
})
->bind('about');

$app->run();










