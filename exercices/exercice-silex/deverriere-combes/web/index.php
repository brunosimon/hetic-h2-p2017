<?php
use Symfony\Component\HttpFoundation\Request;
require 'config.php';


//Page d'acceuil

$app->get('/', function()
{
 global $app;
 global $snippets_model;

	$data = array(
	  'title'=> 'Home',
	  'snippets' => $snippets_model->get(),
	  'pages' => $snippets_model->get_pages(1),
	);
    return $app['twig']->render('home.twig',$data);
})
->bind('home');

//Pagination

$app->get('/page/{page}', function($page) {
    global $app;
    global $snippets_model;

	$data = array(
	   'title'=> 'Page',
	   'snippets' => $snippets_model->get_by_page($page),
	   'pages' => $snippets_model->get_pages($page),
	);
    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('id','\d+');




// Categories
$app->get('category/{category}',function($category)
{
    global $app;
    global $snippets_model;

 	$data = array(
		'title'=> 'Category',
		'snippets' => $snippets_model->get_by_category_slug($category),
	);
    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+'); // Slug





//SUGGEST
$app->match('/suggest', function(Request $request)
{
	global $app;
	global $snippets_model;

	$form = $app ['form.factory']->createBuilder('form')
		->add('name')
		->add('category')
		->add('message','textarea')
		->getForm();

	$form->handleRequest($request);

	if($form->isValid())
	{
		$data = $form->getData();
        $snippets_model->add_snippet($data);
	}
	$data = array (
		'title' => 'Category',
		'form'  => $form->createView(),
		// tentative de sanetize
		//'snippets' => $snippets_model->sanetize($request)

	);
	return $app['twig']->render('suggest.twig', $data);
})
->bind('suggest');


// tentative d'email via Silex

$app->get('/mail',function(Request $request)
{
    global $app;
    global $snippets_model;

	$message = \Swift_Message::newInstance()
	        ->setSubject('Test Mail')
	        ->setFrom(array('noreply@yoursite.com'))
	        ->setTo(array('kikoo.lol.rpz@gmail.com'))
	        ->setBody($request->get('message'));
	$data = array(
	  	'title'=> 'Email'
 );
    return $app['twig']->render('email.twig',$data);
})
->bind('email');

// About

$app->get('about',function(Request $request)
{
    global $app;
    global $snippets_model;

 $data = array(
  'title'=> 'About',
 );
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

$app->run();
