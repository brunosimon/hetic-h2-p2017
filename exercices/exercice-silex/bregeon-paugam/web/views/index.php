<?php

use Symfony\Component\HttpFoundation\Request;

require 'config.php';

// Home
$app->get('/', function()
{
    global $app;
    global $snippets_model;

	$data = array(
		'title' => 'Home',
		'snippets' => $snippets_model->get(),
    'pages' => $snippets_model->get_pages(1),

  );
    
    return $app['twig']->render('home.twig',$data);
})
->bind('home');

// Pages
$app->get('/page/{page}',function($page)
{
  	global $app;
  	global $snippets_model;

  	$data = array(
		'title' => 'Page',
		'snippets' => $snippets_model->get_by_page($page),
    'pages' => $snippets_model->get_pages($page)


	);

    return $app['twig']->render('page.twig',$data);
})
->assert('page','\d+')// Number
->bind('page'); 

// Category
$app->get('/category/{category}',function($category)
{
    global $app;
    global $snippets_model;
    
    $data = array(
  		'title' => 'Category',
  		'snippets' => $snippets_model->get_by_category_slug($category),
	);
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+') // Slug
->bind('category'); 


//About
$app->get('/about',function()
{
    global $app;
    $data = array(
      'title' => 'About',

  );
    return $app['twig']->render('about.twig',$data);
})

->bind('about'); 


//Categories
$app->get('categories',function()
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Categories',
        'categories' => $snippets_model->get_by_categories()
    );
    return $app['twig']->render('categories.twig',$data);
})

->bind('categories');


//Contact
$app->match('/contact', function (Request $request)
{
    global $app;

    $formdata = array(
        'name'     => 'Votre nom',
        'email'   => 'Votre email',
        'subject'   => 'Sujet du message',
        'message' => 'Votre message'
    );

    $form = $app['form.factory']->createBuilder('form', $formdata)
        ->add('name')
        ->add('email')
        ->add('subject')
        ->add('message', 'textarea')
        ->getForm();

     $form->handleRequest($request);

    if ($form->isValid()) {
        $formdata = $form->getData();

        $contactEmail = 'megbregeon@gmail.com';
        $headers = 'From: ' . $contactEmail . "\r\n" .
          'Reply-To: ' . $formdata['email'] . "\r\n" .
          'X-Mailer: PHP/' . phpversion();
 
        $message = sprintf('Richard,\r\n.
            You were sent a message using the contact form on your website.\r\n
            Message: %s.\r\n
            It was sent from %s who can be contacted at %s.',
          $formdata['message'], $formdata['name'], $formdata['email']);
 
      if (mail($contactEmail, 'Contact Form', $formdata['message'], $headers))
      {
        echo "1";
      }
      else {
        echo "2";
      }
    }

    $data = array(
        'title'   => 'Contact',
        'form' => $form->createView()
    );

        // display the form
    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

//Add Snipet
$app->match('/addsnippets',function(Request $request)
{
    global $app;
    global $snippets_model;

    $formdata = array(
        'category' => 'Catégorie',
        'Titre'   => 'Titre du snippet',
        'content'   => 'Contenu du snippet',
    );

    $form = $app['form.factory']->createBuilder('form', $formdata)
        ->add('category', 'choice', array(
            'choices' => array(1 => 'Javascript', 2 => 'PHP', 3 => 'HTML', 4 => 'CSS' ),
            'expanded' => false,
          ))
        ->add('title')
        ->add('content', 'textarea')
        ->getForm();

     $form->handleRequest($request);

      $data = array(
        'title'   => 'Add',
        'form' => $form->createView()
       );

  if($request->getMethod() == 'POST'){

    $form_return = $data['form']->vars['value'];
    $state = $snippets_model->post_snippet($form_return);

    if ($state == "success")
      echo 'Bien envoyé !';
    elseif ($state == "NON")
      echo 'Probleme';
  }

    return $app['twig']->render('addsnippets.twig',$data);
})

->bind('addsnippets');

$app->run();

