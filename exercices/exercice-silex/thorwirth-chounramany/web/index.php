<?php

require 'config.php';
use Symfony\Component\HttpFoundation\Request;


//Home
$app->get('/', function() {
	global $app;
    global $snippets_model;

	$data = array(
        'title' => 'home',
        'snippets' => $snippets_model->get(),
        'pages' => $snippets_model->get_pages(1),
	);
    return $app['twig']->render('home.twig',$data);
})
->bind('home'); // sert d'identifiant pour la route, pour l'url rewritting


//Page
$app->get('/page/{page}', function($page) {
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'page',
        'snippets' => $snippets_model->get_by_page($page),
        'pages' => $snippets_model->get_pages($page),
    );

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');


//Category
$app->get('/category/{category}', function($category) {
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'category',
        'snippets' => $snippets_model->get_by_category_slug($category),
    );

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('id','[a-z0-9-]+');

//About
$app->get('/about', function() {
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'about',
        'snippets' => $snippets_model->get(),
    );
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

//Suggest
$app->match('/suggest', function(Request $request) {
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('category')
        ->add('content','textarea')
        ->getForm();

    $form->handleRequest($request);

    if($form->isValid())
    {
        $data = $form->getData();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $name = $data['name'];
        $category = $data['category'];
        $content = $data['content'];

        $prepare = $pdo->prepare('INSERT INTO snippets (title,content) VALUES (:name,:content)');
        $prepare->bindValue(':name',$name);
        $prepare->bindValue(':content',$content);
        $exec = $prepare->execute();

    }

    $data = array(
        'title' => 'suggest',
        'form'  => $form->createView(),
    );

    return $app['twig']->render('suggest.twig',$data);
})
->bind('suggest');

//Contact
$app->match('/contact', function(Request $request) {
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('email')
        ->add('name')
        ->add('subject')
        ->add('message','textarea')
        ->getForm();

    $form->handleRequest($request);

    if($form->isValid())
    {
        $data = $form->getData();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // exit;

        $email   = $data['email'];
        $name    = $data['name'];
        $subject = $data['subject'];
        $message = $data['message'];
        $to      = 'axel.thorwirth@gmail.com';
        $headers = 'MIME-Version:1.0'."\r\n".
           'From:server@domain.com'."\r\n";

        mail($to,$subject,$message,$headers);

    }

    $data = array(
        'title' => 'contact',
        'form'  => $form->createView(),
    );

    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

$app->run();
?>
<link rel="stylesheet" href="src/css/style.css">
