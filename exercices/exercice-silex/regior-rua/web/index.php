<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
require 'config.php';


	// Gestion des routes

	// Définition des routes (ordre des routes, important)
	// Premier paramètre : chemin
	// Second paramètre : quelle fonction, que faire lorsqu'on va sur cette route
	// assert (méthode, chaînée, suit le get donc ->) permet de règlementer ce qu'on renvoit


	/*********

	Route Home

	**********/

$app->get('/', function() {

	//Il faut récupérer $app car déclaré à l'extérieur de la fonction.
	global $app;
	global $snippets_model;

	// le tableau permet d'envoyer les donner à twig pour faire un rendu de la vue.
	$data = array(
		'title'    => 'Home',
		'snippets' => $snippets_model->get(),
		'pages'    => $snippets_model->get_pages(1)
	);
	return $app['twig']->render('home.twig',$data); // ici on appelle twig pour faire un rendu de notre vue.

})
->bind('home'); //alias, nom de référence pour le chemin valeur à assigner lorsqu'on veut appeler une route en twig <a href="{{url('test')}}">mylink</a>


	/*********

	Route Test

	**********/

$app->get('/test', function() {

	global $app;

	$data = array(
		'title'    => 'Test Coucou',

		//if
		'mavaleur' => false,

		//afficher variable
		'valuename' => 'Meghan',

		//foreach
    		'valuesfor' => array(
        		'key1' => 'value 1',
        		'key2' => 'value 2',
        		'key3' => 'value 3',
        		'key4' => 'value 4',
        		'key5' => 'value 5',
    		),

    	//chercher valeur tableau
    		'tabletest' => array(
    			'key1' => 'je',
    			'key2' => 'm\'apelle',
    			'key3' => 'Meghan',
    			)
		);
	return $app['twig']->render('test.twig',$data);
})
->bind('test');


	/*********

	Route Page

	**********/

$app->get('/page/{page}',function($page){

	global $app;
	global $snippets_model;

		$data = array(
			'title' => "Page",
			'snippets' => $snippets_model->get_by_page($page),
			'pages' => $snippets_model->get_pages($page),
    	);

	return $app['twig']->render('page.twig',$data);

})
->assert('page','\d+') //regex, on force à n'afficher que si la page est un nombre, sinon on n'affiche pas ex:pagination
->bind('page');


	/*********

	Route Category

	**********/

$app->get('/category/{category}',function($category){

	global $app;
	global $snippets_model;

		$data = array(
			'title' => "Category",
			'snippets' => $snippets_model->get_by_category_slug($category),
    	);

	return $app['twig']->render('category.twig',$data);


})
->assert('category','\w+')
->bind('category');

	/*********

	Slugify function

	**********/

function slugify($slug) {
    $bad = array( 'Š','Ž','‘','ž','Ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ',
   'Ò','Ó','Ô','Õ','Ö','Ø','Ù','Ú','Û','Ü','Ý','à','á','â','ã','ä','å','ç','è','é','ê',
   'ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ý','ÿ',
   'Þ','þ','Ð','ð','ß','Œ','œ','Æ','æ','µ',
   '”',"'",'“','"',"\n","\r",'_','&',':','/');

   $good = array( 'S','Z','s','z','Y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N',
   'O','O','O','O','O','O','U','U','U','U','Y','a','a','a','a','a','a','c','e','e','e',
   'e','i','i','i','i','n','o','o','o','o','o','o','u','u','u','u','y','y',
   'TH','th','DH','dh','ss','OE','oe','AE','ae','u',
   '','-','','','','','-','','','');

   // replace strange characters with alphanumeric equivalents
   $slug = str_replace( $bad, $good, $slug );

   $slug = trim($slug);

   // remove any duplicate whitespace, and ensure all characters are alphanumeric
   $bad_reg = array('/\s+/','/[^A-Za-z0-9\-]/');
   $good_reg = array('-','');
   $slug = preg_replace($bad_reg, $good_reg, $slug);

   // and lowercase
   $slug = strtolower($slug);

   return $slug;
}

	/*********

	Route Categories

	**********/

$app->match('/categories', function (Request $request) use ($app, $snippets_model){

	// global $app;

	$data = array(
		'title' => "Categories",
		'categories' =>  $snippets_model->get_categories()
    );

	$new_cat = $request->get('newCategory');
    $snippets_model->add_category($new_cat, slugify($new_cat));

	return $app['twig']->render('categories.twig',$data);

})
->assert('categories','\w+')
->bind('categories');


	/*********

	Route About

	**********/

$app->get('/about',function(){

	global $app;

		$data = array(
			'title' => "About",
    	);

	return $app['twig']->render('about.twig',$data);

})
->bind('about');


	/*********

	Route Form Contact

	**********/

$app->match('/contact', function (Request $request) use ($app, $form_model) {
    // some default data for when the form is displayed the first time

	global $app;

	$data = array();

	if($request->getMethod() == "POST")
	{

		$form = array(
			'name' => $request->get('name'),
			'email' => $request->get('email'),
			'message' => $request->get('message'),
			'subject' => $request->get('subject'),

		);


		$ok = true;

		if(empty($form['name'])){
			$data['error']['name'] = 'Name empty';
			$ok = false;
		}

		if(empty($form['email'])){
			$data['error']['email'] = 'Email empty';
			$ok = false;
		}

		if(empty($form['subject'])){
			$data['error']['subject'] = 'Subject empty';
			$ok = false;
		}

		if(empty($form['message'])){
			$data['error']['message'] = 'Message empty';
			$ok = false;
		}

		if($ok)
		{
			$data['success'] = 'Your email has been sent';
			$form_model->addContact($form);

			$message = \Swift_Message::newInstance()
        	->setSubject('[Subject] ' . $form['subject'])
        	->setFrom(array($form['email']))
        	->setTo(array('regior.meghan@gmail.com'))
        	->setBody(' Message de ' . $form['email'] . ' : ' . $form['message']);

    		$app['mailer']->send($message);

		}
		else
		{
			$data['form'] = $form;
		}

	}

    $data['title'] = 'Contact';

    return $app['twig']->render('contact.twig', $data);
})
->bind('contact');


	/*********

	Route Form AddSnippet

	**********/

$app->match('/add', function (Request $request) use ($app, $form_model, $snippets_model) {
    // some default data for when the form is displayed the first time

	global $app;

	$data = array();

	if($request->getMethod() == "POST")
	{

		$formSnippet = array(
			'snippetName' => $request->get('snippetName'),
			'snippetSelect' => $request->get('snippetSelect'),
			'textSnippet' => $request->get('textSnippet'),
		);


		$ok = true;

		if(empty($formSnippet['snippetName'])){
			$data['error']['snippetName'] = 'Name empty';
			$ok = false;
		}

		if(empty($formSnippet['textSnippet'])){
			$data['error']['textSnippet'] = 'Snippet empty';
			$ok = false;
		}

		if($ok)
		{
			$data['success'] = 'Your snippet has been sent';
			$form_model->addSnippet($formSnippet);
		}

		else
		{
			$data['form'] = $formSnippet;
		}

	}

    $data['title'] = 'Add';
    $data['categories'] = $snippets_model->get_categories();

    return $app['twig']->render('add.twig', $data);
})
->bind('add');

$app->run();
