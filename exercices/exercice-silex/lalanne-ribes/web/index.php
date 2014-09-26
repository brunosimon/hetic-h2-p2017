<?php

require 'config.php';


// Home **********************************************//
$app->get('/', function()
{
    global $app; 
    global $snippets_model;

    $data = array( // données envoyées a twig  
       'title'      => 'Home',
       'snippets'   => $snippets_model->get(),
       'pages'      => $snippets_model->get_pages(1),
    );


    return $app['twig']->render('home.twig',$data);
})
->bind('home'); 

// Pages **********************************************//
$app->get('page/{page}',function($page)
{
    global $app; // pr pouvoir réutiliser la fct
    global $snippets_model;

    $data = array( // données envoyées a twig  
       'title'      => 'Page',
       'snippets'   => $snippets_model->get_by_page($page),
       'pages'      => $snippets_model->get_pages($page),
    );

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+'); // Number


// Categories **********************************************//
$app->get('category/{category}',function($category)
{
    global $app; // pr pouvoir réutiliser la fct
    global $snippets_model;

    $data = array( // données envoyées a twig  
       'title'      => 'Category',
       'snippets'   => $snippets_model->get_by_category_slug($category),
    );

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+'); // Slug

// Formulaire **********************************************//
$app->match('formulaire', function()
{
    global $app;
    global $snippets_model;

    if(!empty($_POST))
    {
        $snippets_model->ajout($_POST);
    }

    $data = array(
        'title' => 'Formulaire',
        'categories' => $snippets_model->get_categories(),
    );

    return $app['twig']->render('formulaire.twig', $data);
})
->bind('formulaire_post');

// About **********************************************//
$app->get('about', function()
{
    global $app; // pr pouvoir réutiliser la fct
    global $snippets_model;

    $data = array( // données envoyées a twig  
       'title'      => 'About',
       'snippets'   => $snippets_model->get(),
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about'); 

// Contact **********************************************//
$app->match('contact', function()
{
    global $app;
    global $contact_model;

    if(!empty($_POST))
    {
        $contact_model->add($_POST);
    }

    $data = array(
        'title' => 'Contact',
    );

    return $app['twig']->render('contact.twig', $data);
})
->bind('contact_post');


$app->run();













