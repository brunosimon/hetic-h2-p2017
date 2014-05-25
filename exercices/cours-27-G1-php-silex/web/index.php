<?php

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
