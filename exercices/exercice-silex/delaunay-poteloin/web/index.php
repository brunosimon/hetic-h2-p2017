<?php

require_once 'config.php';
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\Request;

//Routes
$app->get('/',function(Silex\Application $app) use ($snippets_model)
{
    $data = array(
        'title' => 'Index',
        'snippets' => $snippets_model->get(),
        'pages' => $snippets_model->get_pages(1)
    );
    return $app['twig']->render('home.twig',$data);
})
->bind('home');

$app->get('/page/{nb}', function(Silex\Application $app, $nb) use ($snippets_model){

    $data = array(
        'title' => 'Page',
        'nb' => $nb,
        'snippets' => $snippets_model->get_by_page($nb),
        'pages' => $snippets_model->get_pages($nb)
    );
    return $app['twig']->render('page.twig',$data);
})
->assert('nb','\d+')
->bind('page');

$app->get('/category/{category}',function(Silex\Application $app, $category) use ($snippets_model){
        $data = array(
            'title' => 'Categories',
            'category' => $category,
            'snippets' => $snippets_model->get_by_category_slug($category)
        );
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+')
->bind('category');

$app->get('/snippet/{id}',function(Silex\Application $app, $id, $category = "all") use ($snippets_model){
        $data = array(
            'title' => 'Snippet',
            'id' => $id,
            'category'=> $category,
            'snippets' => $snippets_model->get_snippet_by_id($id)
        );
    return $app['twig']->render('print_snippet.twig',$data);
})
->assert('snippet','[a-z0-9-]+')
->bind('snippet');

$app->get('/categories/',function(Silex\Application $app) use ($snippets_model){
        $data = array(
            'title' => 'Categories',
            'categories' => $snippets_model->get_categories()
        );
    return $app['twig']->render('categories.twig',$data);
})
->bind('categories');

$app->match('/form', function(Request $request) use ($app, $form_model){

    $form_return = $form_model->create_form_contact($request, $app);

    $data = array(
        'title' => 'Form',
        'data' => $form_return['data_form'],
        'form' => $form_return['form']->createView()
    );

    if ($request->getMethod() == "POST") {
        $data_form_request = $data['form']->vars['value'];

        $send = $form_model->send_mail(
            $data_form_request['subject'], 
            $data_form_request['email'], 
            $data_form_request['name'], 
            'clem.delaunay@gmail.com', 
            $data_form_request['text_mail']
        );
        $data['send'] = $send;
        
    }

    return $app['twig']->render('form.twig', $data);
})
->bind('form');

$app->match('/add', function(Request $request) use ($app, $snippets_model){

    $form_return = $snippets_model->create_form_add($request, $app);

    $data = array(
        'title' => 'Add Snippet',
        'data' => $form_return['data_form'],
        'form' => $form_return['form']->createView()
    );

    if ($request->getMethod() == "POST") {
        $data_form_request = $data['form']->vars['value'];

        $add = $snippets_model->add_snippet(
            $data_form_request['name'], 
            $data_form_request['category'], 
            $data_form_request['text_snippet']
        );
        $data['add'] = $add;
        
    }

    return $app['twig']->render('add.twig', $data);
})
->bind('add');

$app->get('/about',function(Silex\Application $app) use ($snippets_model){
        $data = array(
            'title' => 'About'
        );
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

//Run App
$app->run();
