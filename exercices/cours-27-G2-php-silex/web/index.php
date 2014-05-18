<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));


// Home
$app->get('/',function()
{
    global $app;

    $data = array(
        'mavaleur'   => 'Toto',
        'montableau' => array(
            'foo'  => 'bar',
            'mad'  => 'ness',
            'tutu' => 'tata'
        )
    );

    return $app['twig']->render('home.twig',$data);
});

// Page
$app->get('/page/{page}', function($page) {
    return 'Page '.$page;
})
->assert('page','\d+');

// Category
$app->get('/category/{category}',function($category)
{
    return 'Category '.$category;
})
->assert('category','[a-z0-9-]+');


$app->run();
