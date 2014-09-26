<?php

require 'config.php';
use Symfony\Component\HttpFoundation\Request;


//Home
//La méthode $app->get() permet de définir une route
$app->get('/', function()
{
	global $app;
	global $bookmarks_model;

	$data = array(
		'title' => 'Home',
		'bookmarks' => $bookmarks_model->get(),
		'pages' => $bookmarks_model->get_pages(1),
	);
    return $app['twig']->render('home.twig',$data);
})
//Le bind est un identifiant qui va permettre de faire des liens entre les routes créées dans index.php. Par ex dans header.twig dans le href on met {{url('home')}} pour appeler cette page.
->bind('home');

//Page
// on défini une route avec un chemin suivi d'un paramètre (ici la function qui renvoi la page)
$app->get('/page/{page}', function($page) {
    global $app;
    global $bookmarks_model;

	$data = array(
		'title' => 'Page',
		'bookmarks' => $bookmarks_model->get_by_page($page),
		'pages' => $bookmarks_model->get_pages($page),
	);
    return $app['twig']->render('page.twig',$data);
})
->bind('page')
//L'assert indique ici le format que l'on souhait pour page. Ici on veut un entier.
->assert('page','\d+');

//Category
$app->get('/category/{category}', function($category) {
    global $app;
    global $bookmarks_model;

	$data = array(
		'title' => 'Category',
		'bookmarks' => $bookmarks_model->get_by_category_slug($category)
	);
    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

//Suggest
$app->match('/suggest',function(Request $request)
{
	global $app;
	global $bookmarks_model;
    global $pdo;

	$form = $app['form.factory']->createBuilder('form')
        ->add('url', 'url')
        ->add('description', 'textarea')
        ->add('category', 'choice', array(
            'choices' => array("1" => "web", "2" => "inspiration", "3" => "icons", "4" => "typography", "5" => "parallax", "6" => "css"),
        ))
        ->add('send', 'submit')
        ->getForm();


    $form->handleRequest($request);

    	if ($form->isValid())
    	{
    	   $data = $form->getData();
    		// echo'<pre>';
    		// print_r($data);
    		// echo '</pre>';
    		// exit;

    	//Mettre le code d'ajout dans la base de données ici

            $prepare = $pdo->prepare('INSERT INTO bookmarks (id_category,url,description) VALUES (:id_category,:url,:description)');

            $prepare->bindValue(':id_category',$data['category']);
            $prepare->bindValue(':url',$data['url']);
            $prepare->bindValue(':description',$data['description']);

            $exec = $prepare->execute();
 		}

    $data = array(
			'title' => 'suggest',
			'form' => $form->createView()
		);

    return $app['twig']->render('suggest.twig',$data);
})
->bind('suggest');

//About
$app->get('/about', function() {
	global $app;
    global $bookmarks_model;

    $data = array(
		'title' => 'About',
		'bookmarks' => $bookmarks_model->get(),
		);
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

//Page 404
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

//Contact
$app->match('/contact',function(Request $request)
{
    global $app;
    global $bookmarks_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('email')
        ->add('message','textarea')
        ->getForm();

    $form->handleRequest($request);

        if ($form->isValid())
        {
            $data = $form->getData();
                // echo'<pre>';
                // print_r($data);
                // echo '</pre>';
                // exit();

            //$contactEmail = 'enquiries@richardhutchinson.me.uk';
            $contactEmail = 'lchenais@gmail.com';
            $headers = 'From: ' . $contactEmail . "\r\n" .
                'Reply-To: ' . $data['email'] . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            $message = sprintf('Richard,\r\n.
                    You were sent a message using the contact form on your website.\r\n
                    Message: %s.\r\n
                    It was sent from %s who can be contacted at %s.',
                $data['message'], $data['name'], $data['email']);

            mail($contactEmail, 'Contact Form', $data['message'], $headers);

            return $app['twig']->render('contact.twig',$data);
            // return $app['twig']->render('contact.twig', array(
            //     'page'  => 'contact',
            //     'title' => 'Page Title',
            //     'submitted' => true,
            // ));
        }

    $data = array(
            'title' => 'suggest',
            'form' => $form->createView()
        );

    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

$app->run();
