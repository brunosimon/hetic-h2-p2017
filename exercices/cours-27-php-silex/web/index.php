<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Home
$app->get('/',function(Silex\Application $app)
{
    $data = array(
        'title' => 'Home'
    );
    return $app['twig']->render('home.twig',$data);
})
->bind('home');

// Pages
$app->get('page/{page}',function(Silex\Application $app, $page)
{
    $data = array(
        'title' => 'Page '.$page,
        'page'  => $page
    );
    return $app['twig']->render('page.twig',$data);
})
->assert('page','\d+') // Number
->bind('page');

// Categories
$app->get('category/{category}',function(Silex\Application $app, $category)
{
    $data = array(
        'title'    => 'Category : '.$category,
        'category' => $category
    );
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+') // Slug
->bind('category');

$app->run();
