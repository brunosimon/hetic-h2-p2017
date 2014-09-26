<?php

use Symfony\Component\HttpFoundation\Request;
require 'config.php';

// Home
$app->get('/',function()
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

// Page
$app->get('/page/{page}', function($page)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
    );

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

// Category
$app->get('/category/{category}',function($category)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Category',
        'snippets' => $snippets_model->get_by_category_slug($category),
    );

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');


// Suggest
$app->match('/suggest',function(Request $request)
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('email')
        ->add('message','textarea')
        ->getForm();

    $form->handleRequest($request);


    if($form->isValid())
    {
        $data = $form->getData();
        echo '<pre>';
        print_r($data);
        echo '</pre>';
        exit;
    }

    $data = array(
        'title' => 'Category',
        'form'  => $form->createView()
    );

    return $app['twig']->render('suggest.twig',$data);
});

$app->run();








