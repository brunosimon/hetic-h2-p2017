<?php

require 'config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


// ROUTE HOME

$app->get('/', function() {

	global $app;
	global $cake_model;

	$data = array(
		'title' => 'home',
		'categories' => $cake_model->get_categories(),
		'cakes' => $cake_model->get(),
		'pages' => $cake_model->get_pages(1),
		'actual_page' => ''
	);
	return $app['twig']->render('home.twig', $data);
})
->bind('home');

// ROUTE PAGINATION

$app->get('/page/{page}', function($page) {
	global $app;
	global $cake_model;

	$data = array(
		'title' => 'Page',
		'cakes' => $cake_model->get_by_page($page),
		'pages' => $cake_model->get_pages($page),
		'categories' => $cake_model->get_categories(),
		'actual_page' => '',
	);
	return $app['twig']->render('page.twig', $data);
})
->bind('page')
->assert('page', '\d+');



// ROUTE CATEGORY

$app->get('/category/{category}', function($category) {
	global $app;
	global $cake_model;

	$data = array(
		'title' => 'Category',
		'cakes' => $cake_model->get_by_category_slug($category),
		'pages' => $cake_model->get_pages($page),
		'categories' => $cake_model->get_categories(),
		'actual_page' => 'category',
	);
	return $app['twig']->render('category.twig', $data);
})
->bind('category')
->assert('category', '[a-z0-9-]+');




//ROUTE CATEGORY CAKE

$app->get('/cakes/{cakes}', function($cakes) {
	global $app;
	global $cake_model;

	$data = array(
		'title' => 'category_total',
		'cakes' => $cake_model->get_by_category_slug($category),
		'pages' => $cake_model->get_pages($page),
		'categories' => $cake_model->get_categories(),
		'actual_page' => 'category',
	);
	return $app['twig']->render('category_total.twig', $data);
})
->bind('categories')
->assert('categories', '[a-z0-9-]+');





// ROUTE ABOUT

$app->get('/about', function() {
	global $app;
	global $cake_model;

	$data = array(
		'title' => 'About',
		'categories' => $cake_model->get_categories(),
		'actual_page' => 'about',
		'actual_page' => 'categories'
	);
	return $app['twig']->render('about.twig', $data);
})
->bind('about');




// ROUTE PROPOSITION

$app->get('/proposition', function() {
	global $app;
	global $cake_model;

	$data = array(
		'title' => 'Proposer une recette',
		'actual_page' => 'category'
	);
	return $app['twig']->render('proposition.twig', $data);
})
->bind('proposition');

$app->post('/proposition', function() {
	global $app;
	global $cake_model;

	$data = array(
		'actual_page' => 'category',
		'categories' => $cake_model->get_categories(),
		'pages'     => $cake_model->get_pages($page)
	);

	if(isset($_POST)){
		$cake_model->add_cake($_POST['name'],$_POST['categorie'],$_POST['description']/*,$_POST['url']*/);
	}
	return $app['twig']->render('home.twig',$data);

});


// ROUTE CONTACT

$app->match('/contact', function(Request $request) {
	global $app;
	global $cake_model;



	$form = $app['form.factory']->createBuilder('form')
        ->add('mail')
        ->add('subject')
        ->add('message')

        ->getForm();

        $form->handleRequest($request);

        if ($form->isValid())
        {
        	$data = $form->getData();

        	// MAIL
        $mail    = $data['mail'];
        $subject = $data['subject'];
		$message = $data['message'];
	    $to      = 'oscar.deloizy@hotmail.fr';

	    echo '<pre>';
	    print_r($data['mail']);
	    echo '</pre>';
	    exit;
	    mail($mail, $subject, $message, $to);

    	}

	$data = array(
		'title' => 'Contact',
		'categories' => $cake_model->get_categories(),
		'form'	=> $form->createView(),
		'actual_page' => 'contact',
		'actual_page' => 'categories'
	);
	return $app['twig']->render('contact.twig', $data);
})
->bind('contact');


// MAIL
	// $message = wordwrap($message, 70, "\r\n");
 //    $to      = '';
 //    $subject = '[SNIPPET CONTACT] '.$title;
 //    $headers = 'From: ' . $email. "\r\n" .
 //    'Reply-To: ' . $email . "\r\n" .
 //    'X-Mailer: PHP/' . phpversion();

 //    mail($to, $subject, $message, $headers);




$app->run();
