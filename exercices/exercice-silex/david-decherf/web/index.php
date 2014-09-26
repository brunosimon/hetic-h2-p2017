<?php

require 'config.php';

use Symfony\Component\HttpFoundation\Request;

// Home
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

// Page
$app->get('/page/{page}', function($page) {
    global $app;
    global $snippets_model;
    global $pages;

    $data = array(
        'title'    => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
        'pages'    => $snippets_model->get_pages($pages)


    );

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

// Category
$app->get('/category/{category}', function($category) {
    global $app;
    global $snippets_model;
    global $pages;

    $data = array(
        'title'    => 'Category',
        'snippets' => $snippets_model->get_by_category_slug($category),
        'pages'    => $snippets_model->get_pages($pages)

    );

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

// About
$app->get('/about', function() {
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'About',
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about');

// Contact
$app->match('/contact', function (Request $request) 
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('email')
        ->add('message','textarea')
        ->getForm();

    if ($form->isValid()) 
    {
        $data = $form->getData();
        $snippets_model->add($data);

        $to = 'valentin.david7@gmail.com';
        $subject = $form['subject'];
        $message = $form['message'];

        mail($to, $subject, $message);
    }

    $data = array(
        'title' => 'Contact',
        'form'  => $form->createView()
    );

    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');



// Suggest
$app->match('/suggest', function (Request $request) 
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('title')
        ->add('snippets','textarea')
        ->add('category', 'choice', array('choices' => array(1 => 'Javascript', 2 => 'PHP', 3 => 'HTML', 4 => 'CSS')))
        ->getForm();

        $form->handleRequest($request);

    if ($form->isValid()) 
    {
        $data = $form->getData();
        $snippets_model->addsnippets($data);
    }

    $data = array(
        'title' => 'Suggest',
        'choices' => array(1 => 'Javascript', 2 => 'PHP', 3 => 'HTML', 4 => 'CSS'),
        'form'  => $form->createView()
    );

    return $app['twig']->render('Suggest.twig',$data);
})
->bind('suggest');


// Categories
$app->get('/categories', function() {
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'categories',
        'categories' => $snippets_model->get_category()
    );

    return $app['twig']->render('categories.twig',$data);
})
->bind('categories');

// Validation
$app->post('/validation', function() {
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'validation',
    );

    return $app['twig']->render('validation.twig',$data);
})
->bind('validation');



$app->run();



