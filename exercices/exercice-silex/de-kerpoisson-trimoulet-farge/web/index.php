<?php

use Symfony\Component\HttpFoundation\Request;
require 'config.php';

// Home
$app->get('/', function() {
	global $app;
	global $snippets_model;



	$data = array (
		'title' => 'Home',
		'snippets'=> $snippets_model->get(),
		'pages' => $snippets_model->get_pages(1),
		'categories' => $snippets_model->get_pages_category_menu(),


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
        'categories' => $snippets_model->get_pages_category_menu(),
	);

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

//About
$app->get('/about', function() {
    global $app;
    global $snippets_model;

    $data = array (
        'title' => 'About',
        'categories' => $snippets_model->get_pages_category_menu(),
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about');


//Category
$app->get('/category/{category}', function($category){
    global $app;
    global $snippets_model;

    $data = array (
		'title' => 'Category',
		'snippets'=> $snippets_model->get_by_category_slug($category),
		'pages'   => $snippets_model->get_pages_category(1,$category),
        'categories' => $snippets_model->get_pages_category_menu(),
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
        'categories' => $snippets_model->get_pages_category_menu(),
	);

    return $app['twig']->render('category.twig',$data);
})
->bind('category_pagination')
->assert('category','[a-z0-9-]+')
->assert('page','\d+');

//Suggest

$app->match('/suggest',function(Request $request)
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('sujet')
        ->add('message','textarea')
        ->getForm();

    $form->handleRequest($request);

    if($form->isValid())
    {
        $data = $form->getData();
        $snippets_model->post_form_suggests($data);

    }

    $data = array(
        'title' => 'Category',
        'form'  => $form->createView(),
        'suggest' => $snippets_model->get_form_suggests(),
        'categories' => $snippets_model->get_pages_category_menu(),
    );

    return $app['twig']->render('suggest.twig',$data);

})
->bind('suggest');

//Contact

$app->match('/contact',function(Request $request)
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('sujet')
        ->add('email')
        ->add('message','textarea')
        ->getForm();

    $form->handleRequest($request);

    if($form->isValid())
    {
        $data = $form->getData();

        $to      = 'maxencedekerpoisson@msn.com';
        $subject = $data['sujet'];
        $subject = $data['email'];
        $message = $data['message'];


        mail($to, $subject, $message);

    }

    $data = array(
        'title' => 'Category',
        'form'  => $form->createView(),
        'categories' => $snippets_model->get_pages_category_menu(),
    );

    return $app['twig']->render('contact.twig',$data);

})
->bind('contact');

$app->run();










