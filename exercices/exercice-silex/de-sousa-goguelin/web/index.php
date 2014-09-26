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



//contact
$app->match('/contact', function(Request $request)
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('email')
        ->add('message','textarea')
        ->getForm();

        $form->handleRequest($request);

    if ($form->isValid())
    {
        $data = $form->getData();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        $snippets_model->add($data);
        exit;
    }

    $data = array(
    	'title' => 'Contact',
    	'form' 	=> $form->createView()
    );

    return $app['twig']->render('contact.twig',$data);

})
->bind('contact');



//ADD Snippets
$app->match('/submit', function (Request $request) use ($app)
{
	global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('title')
        ->add('category', 'choice', array(
            'choices' => array(1 => 'javascript', 2 => 'php', 3 => 'html', 4 => 'css'),
            'expanded' => true,
         ))
        ->add('content')
        ->getForm();

        $form->handleRequest($request);

    if ($form->isValid())
    {
        $data = $form->getData();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        $snippets_model->add_snip($data);

    }

    $data = array(
    	'title' => 'Snippet',
    	'form' 	=> $form->createView()
    );

    return $app['twig']->render('pets.twig',$data);

})
->bind('submit');

// About
$app->get('/about', function(Request $request)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'about',
        'content'  => 'Bonjour, ce site web a été crée par Wladimir et Vincent dans le cadre du cour de Développement Web!!!',
        'snippets' => $snippets_model->get_about($request)
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about');

$app->run();





