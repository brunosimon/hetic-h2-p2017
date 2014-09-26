<?php

//SUJET
/*
- Pagination (ex : page/2)
- Une page listant toutes les catégories cliquables
- Une page permettant de soumettre un snippets (formulaire)
- Une page About (juste du texte)
- Une page de contact (formulaire)
- Un minimun de design (bootstrap)

*/

require 'config.php';

//Home
$app->get('/', function() { // ajout d'une route

	global $app; //récup mes variables à l'exterieur
	global $snippets_model;

	$data = array(
		'title' 	=> 'Home',
		'snippets' 	=> $snippets_model->get(),
		'pages'		=> $snippets_model->get_pages()
	);

    return $app['twig']->render('home.twig',$data);
})
->bind('home'); //liens entre les pages

//category
$app->get('/category/{category}', function($category) {

    global $app;
    global $snippets_model;

	$data = array(
		'title' 	=> 'Category',
		'snippets' 	=> $snippets_model->get_by_category_slug($category),
		'pages'		=> $snippets_model->get_pages()
	);

    return $app['twig']->render('category.twig',$data);
})
-> assert('category','[a-z0-9-]+')
->bind('category');

//Page
 $app->get('/page/{page}', function($page) {

     global $app;
     global $snippets_model;

 	$data = array(
 		'title' 	=> 'Page',
 		'snippets' 	=> $snippets_model->get_by_page($page),
 		'page'  	=> $page,
 		'pages' 	=> $snippets_model->get_pages($page)
 	);

     return $app['twig']->render('page.twig',$data);
 })
 ->assert('page','\d+')
 ->bind('page');


//add_snippets
$app->get('add_snippets', function() { // ajout d'une route

	global $app; //récup mes variables à l'exterieur
	global $snippets_model;

	$data = array(
		'title' 	=> 'add_snippets',
		'snippets' 	=> $snippets_model->get(),
	);

    return $app['twig']->render('add_snippets.twig',$data);
})
->bind('add_snippets'); //liens entre les pages$app->get('/about', function($page)


$app->post('add_snippets',function() use ($app, $snippets_model)
	{

		if(isset($_POST)){
			$snippets_model->new_snippet($_POST['title'], $_POST['category'], $_POST['content']);
		}

		$data = array(
        'title'     => 'Home',
        'snippets'     => $snippets_model->get(),
        'pages'        => $snippets_model->get_pages()
		);
		return $app['twig']->render('home.twig',$data);
	});

//Contact
//http://silex.sensiolabs.org/doc/providers/swiftmailer.html
$app->match('/contact', function() use ($app) {

	global $app;
	global $contact_model;

	$data = array(
		'title'    	=> 'contact page',
		'name'    	=> '',
  		'email'		=> '',
  		'subject'	=> '',
  		'message' 	=> ''
	);
	$request = $app['request'];

	$message = \Swift_Message::newInstance()
        //->setFrom(array('email'))
		->setSubject(array('subject'))
        ->setTo('simon.bruno.77@gmail.com')
        ->setBody($request->get('message'));

    $app->register(new Silex\Provider\SwiftmailerServiceProvider());

	if (!empty($_POST))
	{
		// $state = $contact_model->insert($_POST);
		if (isset ($state['sent'])){
			$data['state_contact'] = $state['sent'];
			$app['swiftmailer.transport']->send($message);
		}
		else if (isset ($state['wrong_email']))
			$data['state_contact'] = $state['wrong_email'];
	}

    return $app['twig']->render('contact.twig',$data);

})
->bind('contact');


//about
$app->get('about', function() { // ajout d'une route

	global $app; //récup mes variables à l'exterieur
	global $snippets_model;

	$data = array(
		'title' 	=> 'about',
		'snippets' 	=> $snippets_model->get(),
	);

    return $app['twig']->render('about.twig',$data);
})
->bind('about'); //liens entre les pages$app->get('/about', function($page)

// Errors
$app->error(function (\Exception $e, $code)
{
    // Globals
    global $app;

    $data = array(
        'title' => $code
    );
    if($code == 404)
        return $app['twig']->render('404.twig',$data);
});

$app->run();

