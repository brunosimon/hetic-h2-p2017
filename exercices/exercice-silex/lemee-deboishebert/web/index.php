<?php

use Symfony\Component\HttpFoundation\Response;
require_once 'config.php';
require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$app['debug'] = true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());


// Home
$app->get('/',function()
{
    // Globals
    global $app;
    global $snippets_model;


    // Prepare data
    $data = array(
        'title'    => 'Home',
        'snippets' => $snippets_model->get(),
        'pages'    => $snippets_model->get_pages()
    );
    return $app['twig']->render('home.twig',$data);
})
->bind('home');


// Pages
$app->get('page/{page}',function($page)
{
    // Globals
    global $app;
    global $snippets_model;

    // Get snippets
    $snippets = $snippets_model->get_by_page($page);

    // Prepare data
    $data = array(
        'title'    => 'Page '.$page,
        'snippets' => $snippets,
        'page'     => $page,
        'pages'    => $snippets_model->get_pages($page)
    );
    return $app['twig']->render('page.twig',$data);
})
->assert('page','\d+') // Number
->bind('page');


// Categories
$app->get('category/{category}/',function($category)
{
    // Globals
    global $app;
    global $snippets_model;

    // Get snippets
    $snippets = $snippets_model->get_by_category_slug($category);

    // Prepare data
    $data = array(
        'title'    => 'Category : '.$category,
        'category' => $category,
        'snippets' => $snippets
    );
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+') // slug
->bind('category');

$app->get('/add',function()
{
    // Globals
    global $app;
    global $snippets_model;


    // Prepare data
    $data = array(
        'title'    => 'Add a snippet'
    );
    return $app['twig']->render('add_snippet.twig',$data);
})
->bind('add_snippet');

$app->get('/about',function()
{
    // Globals
    global $app;
    global $snippets_model;


    // Prepare data
    $data = array(
        'title'    => 'About'
    );
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

$app->post('/post_form',function()
{
    // Globals
    global $app;
    global $snippets_model;
    
    if(isset($_POST['name']) && isset($_POST['category']) && isset($_POST['snippet']))
    {
    	$snippets_model->add_snippet($_POST['name'], $_POST['category'], $_POST['snippet']);
    }
    
    // Prepare data
    $data = array(
        'title'    => 'About'
    );
    return $app['twig']->render('post_form.twig',$data);
})
->bind('post_form');


// Errors
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

$app->run();
