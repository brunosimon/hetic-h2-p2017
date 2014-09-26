<?php
use Symfony\Component\HttpFoundation\Request;
require_once'config.php';

// Accueil
$app->get('/', function() 
{
	global $app;
	global $snippets_model;

	$data = array(
		'title' => 'Home',
		'snippets' => $snippets_model->get(),
	);

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

$app->get('/about/', function() 
{
	global $app;
	global $snippets_model;

	$data = array(
		'title' => 'About',
		'snippets' => $snippets_model->get(),
	);

    return $app['twig']->render('about.twig',$data);
})
->bind('about');

// Page
$app->get('/page/{page}', function($page) 
{
		global $pdo;
    global $app;
    global $snippets_model;

    $result = $pdo->query('SELECT id, slug, nom FROM consoles');
	$consoles  = $result->fetchAll();

	$result = $pdo->prepare('SELECT count(*) FROM circuits'); 
	$result->execute(); 
	$number_of_rows = $result->fetchColumn(); 

	if ($number_of_rows > $page * 4){
		$max_page = 0;
	} else {
		$max_page = 1;
	}

	$data = array(
		'title' => 'Page',
		'snippets' => $snippets_model->get_by_page($page),
		'actual_page' => $page,
		'max_page' => $max_page
	);

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');


$app->get('/consoles', function() 
{
	global $app;
	global $category_model;

	$data = array(
		'title' => 'Consoles',
		'categories' => $category_model->get(),
	);

    return $app['twig']->render('consoles.twig',$data);
})
->bind('consoles');

// Category
$app->get('/category/{category}', function($category)
{
    global $app;
    global $snippets_model;

	$data = array(
		'title' => 'Category',
		'snippets' => $snippets_model->get_by_category_slug($category),
	);

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

// Suggest
$app->match('/suggest/',function(Request $request){
	global $pdo;
	global $app;
	global $snippets_model;

	$sent = 0;

	$array_consoles = array();

	$result = $pdo->query('SELECT id, slug, nom FROM consoles');
	$consoles  = $result->fetchAll();

	foreach ($consoles as $console){
		$array_consoles[$console['id']] = $console['nom'];
	}

	$form = $app['form.factory']->createBuilder('form')
		->add('nom_du_circuit')
		->add('url_image')
		->add('console', 'choice', array(
		    'choices'   => $array_consoles,
		    'multiple'  => false,
		))
		->getForm();

	$form->handleRequest($request);

	if($form->isValid()){
		$data = $form->getData();


		$prepare = $pdo->prepare('INSERT INTO circuits (nom, id_console, img) VALUES (:nom,:id,:img)');
		$prepare->bindValue(':nom',$data['nom_du_circuit']);
		$prepare->bindValue(':id',$data['console']);
		$prepare->bindValue(':img',$data['url_image']);
		$exec = $prepare->execute();

		$sent = 1;

	}



	$data = array(
		'title' => 'Suggest',
		'form'  => $form->createView(),
		'sent' 	=> $sent 
	);

	return $app['twig']->render('suggest.twig',$data);
})
->bind('suggest');

$app->match('/contact/',function(Request $request){
	global $app;

	$sent = 0;
	$form = $app['form.factory']->createBuilder('form')
		->add('nom')
		->add('email')
		->add('objet')
		->add('message','textarea')
		->getForm();

	$form->handleRequest($request);

	if($form->isValid()){
		$data = $form->getData();

		mail("j.dachaud@gmail.com" , $data['objet'] , "De : ".$data['nom']." / ".$data['email']." Message : ".$data['message']);

		$sent = 1;
	}

	$data = array(
		'title' => 'Contact',
		'form'  => $form->createView(),
		'sent' 	=> $sent 
	);

	return $app['twig']->render('contact.twig',$data);
})
->bind('contact');


$app->run();
