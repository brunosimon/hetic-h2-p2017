<?php

require 'config.php';
require_once __DIR__.'/../vendor/autoload.php';

include('models/snippets.class.php');
$snippets_model = new Snippets_model($pdo);

$app = new Silex\Application();
$app['debug']=true;

// Twig
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());

// Used for requests
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

$app->before(function() use ($app,$snippets_model){
    $categories = $snippets_model->get_categories();
    $app["twig"]->addGlobal("categories", $categories);
});

$app->get('/', function($page) use ($app,$snippets_model) {
    $snippets = $snippets_model->get_all();
    $pages = $snippets_model->get_pages_all();
    $app["twig"]->addGlobal("actualPage", array("page" => "home", "category" => "all"));
    
    return $app['twig']->render('snippets.twig',array(
        'snippets' => $snippets, 
        "pages" => $pages
    ));

})
->value('page', 1)
->bind('home');

$app->get('/category/{category}/{page}', function($category="all",$page=1) use($app,$snippets_model){

    if($category=="all"){
        $snippets = $snippets_model->get_all($page);
        $pages = $snippets_model->get_pages_all($page);

        $cat_details = array(
            'slug'=>'all',
            'title'=>'All',
            'count' => $snippets_model->get_snippets_count()
        );

    }else{

        $cat_details = $snippets_model->get_cat_details($category);
        $cat_details = $cat_details[0];

        $snippets = $snippets_model->get_by_category($category,$page);
        $pages = $snippets_model->get_pages_by_category($cat_details['id'],$page);
    }


    $app["twig"]->addGlobal("actualPage", array("page" => "category", "category" => $category));
    
    return $app['twig']->render('snippets.twig',array(
        'snippets' => $snippets, 
        "pages" => $pages, 
        'catdetails' => $cat_details
    ));

})
->value('page', 1)
->bind('category');

$app->post('/add_snippet', function (Request $request) use ($app,$snippets_model) {
    $title = $request->get('title');
    $message = $request->get('message');
    $category = $request->get('category');

    if(empty($title) || empty($message) || empty($category)){
        die('error');}

    $snippets_model->add_snippet($title,$message,$category);
    die('ok');
    
})->bind('add_snippet');

$app->get('/about', function() use($app,$snippets_model){
    $app["twig"]->addGlobal("actualPage", array("page" => "about"));
    return $app['twig']->render('about.twig');
})->bind('about');

// contact form
$app->get('/contact', function() use($app,$snippets_model){
    $app["twig"]->addGlobal("actualPage", array(
        "page" => "contact"
    ));
    return $app['twig']->render('contact.twig');
})->bind('contact');

$app->post('/contact_submit', function (Request $request) use ($app,$snippets_model){

    $title = $request->get('title');
    $name = $request->get('name');
    $email = $request->get('email');
    $message = $request->get('message');

    if(empty($title) || empty($name) || empty($email) || empty($message)){
        die('error');
    }

    $message = wordwrap($message, 70, "\r\n");
    $to      = 'tfarneau@gmail.com';
    $subject = '[SNIPPET CONTACT] '.$title;
    $headers = 'From: ' . $email. "\r\n" .
    'Reply-To: ' . $email . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers);

    die('ok');
    
})->bind('contact_submit');

$app->run();