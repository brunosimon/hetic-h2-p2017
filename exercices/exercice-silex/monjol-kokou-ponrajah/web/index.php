<?php

require_once 'config.php';
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


// Home
$app->get('/',function() use ($app, $snippets_model){

    $data = array(
        'title'    => 'Home',
        'snippets' => $snippets_model->get(),
        'pages' => $snippets_model->get_pages(1),
        );
return $app['twig']->render('home.twig',$data);
})
->bind('home');


//CATEGORY
$app->get('/category/{category}', function($category) use ($app, $snippets_model){

    $data = array(
        'title'    => 'Category',
        'snippets' => $snippets_model->get_by_category_slug($category),
        );
    return $app['twig']->render('category.twig',$data);
})
->assert('category', '[a-z0-9-]+')
->bind('category');


//PAGE
$app->get('/page/{page}', function($page) use ($app, $snippets_model){

    $data = array(
        'title'    => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
        'pages' => $snippets_model->get_pages($page)
        );
    return $app['twig']->render('page.twig',$data);
})
->assert('page', '\d+')
->bind('page');


//Single snippet
$app->get('/snippet/{id}', function($id) use ($app, $snippets_model){

    $data = array(
        'title'    => 'Page',
        'snippets' => $snippets_model->get_snippet($id),
        );
    return $app['twig']->render('single_snippet.twig',$data);
})
->assert('id', '\d+')
->bind('snippet');


// ADD SNIPPET SEND
$app->match('/addsnippet' ,function(Request $request) use ($app, $snippets_model){

    $form = array (
        'select'  => $request->get('select'),
        'title'   => $request->get('title'),
        'content' => $request->get('content'),
    );

    $data = array(
        'title'  => 'add snippet'
    );

    /*Form Check*/
    if(empty($form['title']))
        $data['error'] = 'empty title';

    else if (empty($form['content']))
        $data['error'] = 'empty content';

    else{
        $data['sucess'] = 'Snippet send';
        $snippets_model->add_snippet($form);
    }

    return $app['twig']->render('addsnippet.twig', $data);
})
->bind('addsnippet');


// ABOUT
$app->get('/about',function() use ($app){

    $data = array(
        'title' => 'About',
        );
return $app['twig']->render('about.twig',$data);
})
->bind('about');



// CONTACT
$app->match('/contact' ,function(Request $request) use ($app, $contact_model){

    $form = array (
        'name'    => $request->get('name'),
        'email'   => $request->get('email'),
        'subject' => $request->get('subject'),
        'content' => $request->get('content'),
    );

    $data = array(
        'title'  => 'Contact'
    );

    /*Form check*/
    if(empty($form['name']))
        $data['error'] = 'name empty';

    else if (empty($form['email']))
        $data['error'] = 'email empty';

    else if (empty($form['subject']))
        $data['error'] = 'subject empty';

    else if (empty($form['content']))
        $data['error'] = 'content empty';

    else{
        $data['sucess'] = 'Message send';
        $contact_model->contact($form);
    }

    return $app['twig']->render('contact.twig', $data);
})
->bind('contact');

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
