<?php

require 'config.php';

use Symfony\Component\HttpFoundation\Request;

// Home
$app->get('/',function()
{
	global $app;
    global $snippets_model;

    $data = array(
        'title' => 'Home',
        'snippets' => $snippets_model->get_by_page(),
        'pages' => $snippets_model->get_pages(),
        'categories' => $snippets_model->get_categories()
    );
    return $app['twig']->render('home.twig',$data);
})
->bind('home');

// Page
$app->get('/page/{page}', function($page) {
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
        'pages' => $snippets_model->get_pages($page),
        'categories' => $snippets_model->get_categories()
    );
    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

// Category
$app->get('/category/{category}', function($category) {
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'Category',
        'snippets' => $snippets_model->get_by_category_slug($category),
        'pages' => $snippets_model->get_pages_categories($category),
        'categories' => $snippets_model->get_categories()
    );
    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

// Suggestion
$app->match('/suggestion', function(Request $request) {
    global $app;
    global $snippets_model;

    $success = false;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('content','textarea')
        ->add('category', 'choice', array(
            'choices' => array(1 => 'Javascript', 2 => 'PHP', 3 => 'HTML', 4 => 'CSS'),
            'required'    => true,
            'empty_value' => 'Select the category',
            'empty_data'  => null,
        ))
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();
        $snippets_model->add($data);
    }

    $data = array(
        'title' => 'Suggestion',
        'form' => $form->CreateView(),
        'categories' => $snippets_model->get_categories()
    );

    return $app['twig']->render('suggestion.twig',$data);
})
->bind('suggestion');

// About
$app->get('/about', function() {
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'About',
        'categories' => $snippets_model->get_categories()
    );
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

// Contact
$app->match('/contact', function(Request $request) use ($app){
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('email')
        ->add('message','textarea')
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

            $name = $data['name'];
            $email = $data['email'];
            $messageBody = $data['message'];

            $subject = "Message from ".$name." - ".$email;

            $message = Swift_Message::newInstance()
                ->setSubject($subject)
                ->setFrom($email)
                ->setTo(array('mguioneau@gmail.com'))
                ->setBody($messageBody);

            $app['mailer']->send($message);
    }

    $data = array(
        'title' => 'Contact',
        'form' => $form->CreateView(),
        'categories' => $snippets_model->get_categories()
    );

    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

$app->run();