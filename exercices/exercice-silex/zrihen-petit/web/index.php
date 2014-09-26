<?php

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

require 'config.php';

// Home
$app->get('/', function()
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Home',
        'snippets' => $snippets_model->get(),
    );

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

// About
$app->get('/about', function()
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'About'
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about');

// Contact

$app->match('/contact' ,function(Request $request) use ($app,$snippets_model){

    $form = array (
        'name'   => $request->get('name'),
        'firstname' => $request->get('firstname'),
        'comment' => $request->get('comment'),
        'email' => $request->get('email')
    );

    // Prepare data
    $data = array(
        'title'  => 'Contact'
    );

    if(empty($form['name'])){
        $data['error'] = 'Nom Empty';
    }
    else if (empty($form['firstname'])){
        $data['error'] = 'Prenom Empty';
    }
    else if (empty($form['comment'])){
        $data['error'] = 'Comment Empty';
    }
    else if (empty($form['email'])){
        $data['error'] = 'Email Empty';
    }
    else{
        $snippets_model->comment($form); 
        $data['sucess'] = 'Good'; 
    }

    return $app['twig']->render('contact.twig', $data);
})


->bind('contact');


// Add Snippet




$app->match('/addsnippet', function(Request $request) use ($app, $snippets_model){

    $form = array (
        'title'     => $request->get('title'),
        'id_category' => $request->get('id_category'),
        'content'  => $request->get('content')
    );

    $data = array(
        'title'    => 'Add Snippet'
    );

    if(empty($form['title'])){
        $data['error'] = 'Name Empty';
    }
    else if(empty($form['content'])){
        $data['error'] = 'Content Empty';
    }
    else{
            $snippets_model->add_snippet($form);
            $data['success'] = "Snippet Added";
    }

    return $app['twig']->render('addsnippet.twig',$data);

})

->bind('addsnippet');

// Page
$app->get('/page/{page}',function($page)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
    );

    return $app['twig']->render('page.twig',$data);
})
->assert('page','\d+')
->bind('page');



// Category
$app->get('/category/{category}',function($category)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Category',
        'snippets' => $snippets_model->get_by_category_slug($category)
    );

    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+')
->bind('category');

$app->run();
