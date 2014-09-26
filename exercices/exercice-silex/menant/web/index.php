<?php

require_once 'config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

// Home
$app->get('/', function()
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
    return $app['twig']->render('home.twig', $data);
})
->bind('home');


// Snippet
$app->get('/snippet/{snippet}', function($snippet)
{
    global $app;
    global $snippets_model;

    $snippet = $snippets_model->get($snippet); 

    if($snippet === false) 
        $app->abort(404, "Oh no ! Snippet doesn't exist.");

    $data = array(
        'title'    => $snippet['title'],
        'snippet' => $snippet
    );

    return $app['twig']->render('snippet.twig',$data);
})
->bind('snippet')
->assert('snippet', '\d+');


// Pages
$app->get('page/{page}', function($page)
{

    // Globals
    global $app;
    global $snippets_model;

    // Get snippets
    $snippets = $snippets_model->get_by_page($page);

    if(!$snippets)
        $app->abort(404, 'Oh sorry, page doesn\'t exist.'); 

    // Prepare data
    $data = array(
        'title'    => 'Page '.$page,
        'snippets' => $snippets,
        'pages'    => $snippets_model->get_pages($page)
    );
    return $app['twig']->render('home.twig', $data);
})
->assert('page','\d+') // Number
->bind('page');


// Search
$app->get('search/{q}/{page}', function($q, $page)
{
    // Globals
    global $app;
    global $snippets_model;

    // Get snippets
    $snippets = $snippets_model->get_by_title($q, $page);

    // Prepare data
    $data = array(
        'title'    => 'Search : '.$q,
        'snippets' => $snippets,
        'pages'    => $snippets_model->get_pages($page, 8, '.', $q),
        'q'        => $q
    );
    return $app['twig']->render('home.twig', $data);
})
->bind('search')
->assert('page','\d+')
->assert('q','[a-zA-Z0-9]+')
->value('page',1);


//Page Categorie
$app->get('category', function(){
    global $app;
    global $snippets_model;
    global $categories_model;

    $data = array(
            'title'    => 'Page categories',
            'categories' => $categories_model->get()
        );
    return $app['twig']->render('categories.twig', $data);
})
->bind('categories');


// Page About
$app->get('about', function()
{    
    global $app;
    global $pages_model;

    $data = array(
        'title' => 'About us',
        'page' => $pages_model->get('About')
    );

    return $app['twig']->render('about.twig', $data);
})
->bind('about');


// Update Page About
$app->match('admin/page/update/{title}', function(Request $request, $title)
{    
    global $app;
    global $pages_model;

    if(!$app['session']->get('admin')) // Si pas connecté
        return $app->redirect($app['url_generator']->generate('login')); // Redirection vers login

    if($_POST){
        $form = array(
            'content' => $request->get('content')
        );

        $constraint = new Assert\Collection(array( 
            'content' => new Assert\NotBlank()
        ));

        $errors = $app['validator']->validateValue($form, $constraint);

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Sinon
            $updated = $pages_model->update(ucfirst($title), $form['content']);
            if($updated === true){ // Si update OK
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Success',
                    'value' => 'Page updated !'
                ));
            }
            else{ // Sinon afficher erreur
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $updated
                ));
            }
        }
    }

    $page = $pages_model->get(ucfirst($title));

    if(!$page)
        $app->abort(404, 'Oh sorry, page doesn\'t exist.');

    $data = array(
        'title' => 'Update ' . $title,
        'page' => $page
    );

    return $app['twig']->render('admin/page.twig', $data);
})
->bind('admin/page/update');


// Categories
$app->get('category/{category}/{page}', function($category, $page)
{
    // Globals
    global $app;
    global $snippets_model;
    global $categories_model;

    // Get snippets
    $snippets = $snippets_model->get_by_category_slug($category, $page);

    // Prepare data
    $data = array(
        'title'    => 'Category : '.$category,
        'snippets' => $snippets,
        'pages'    => $snippets_model->get_pages($page, 8, $category),
        'category' => $category
    );
    return $app['twig']->render('category.twig', $data);
})
->bind('category')
->assert('category','[a-z0-9-]+') // slug
->assert('page','\d+')
->value('page', 1);


// Addsnippet page
$app->match('add', function(Request $request)
{
    // Globals
    global $app;
    global $snippets_model;
    global $categories_model;

    if($_POST){

        // Stock form
        $form = array(
            'title'    => $request->get('title'),
            'content'    => $request->get('content'),
            'category'    => (int)$request->get('category')
        );

        $constraint = new Assert\Collection(array( 
            'title' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 3))),
            'content' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 5))),
            'category' => array(new Assert\NotBlank(), new Assert\Type(array('type'=> 'integer')))
        ));

        $errors = $app['validator']->validateValue($form, $constraint); 

        if (count($errors) > 0) { // Si erreurs de validation
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array( 
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Sinon
            $snippets_model->add($form);
            $app['session']->getFlashBag()->add('message', array( 
                'type' => 'Success',
                'value' => 'Snippet added !'
            ));
        }
    }

    // Prepare data
    $data = array(
        'title'    => 'Add snippet',
        'categories' => $categories_model->get()
    );
    return $app['twig']->render('addsnippet.twig', $data);
})
->bind('addsnippet');


// Contact
$app->match('contact', function(Request $request){
    // Globals
    global $app;

    if($_POST){
        $form = array( 
            'email' => $request->get('email'),
            'objet' => $request->get('objet'),
            'content' => $request->get('content')
        );

        $constraint = new Assert\Collection(array( 
            'email' => array(new Assert\NotBlank(), new Assert\Email()),
            'objet' => new Assert\NotBlank(),
            'content' => array(new Assert\NotBlank())
        ));

        $errors = $app['validator']->validateValue($form, $constraint); 

        if (count($errors) > 0) { // Si erreurs de validation
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Sinon
            $message = \Swift_Message::newInstance() 
                ->setSubject($form['objet']) // Sujet
                ->setFrom($form['email']) // From
                ->setReplyTo($form['email']) // Reply to
                ->setTo('9centis@gmail.com') // Envoyé à
                ->setBody($form['content']); // Message

            $app['mailer']->send($message);
            $app['session']->getFlashBag()->add('message', array( 
                'type' => 'Success',
                'value' => 'Message send !'
            ));
        }
    }

    // Prepare data
    $data = array(
        'title'    => 'Contact me'
    );
    return $app['twig']->render('contact.twig', $data);
})
->bind('contact');


// Login
$app->match('/login', function(Request $request)
{
    global $app;
    global $admins_model;

    if($app['session']->get('admin')) // Si déjà connecté
        return $app->redirect($app['url_generator']->generate('home')); // Redirection vers la home

    if($_POST){
        $form = array(
            'username' => strtolower($request->get('username')),
            'password' => $request->get('password')
        );

        $admin = $admins_model->is_admin($form);

        if($admin === true){
            $app['session']->set('admin', array('username' => $form['username'])); // Ajout de la session administrateur

            return $app->redirect($app['url_generator']->generate('home')); // Redirection vers la home
        }
        else{
            $app['session']->getFlashBag()->add('message', array(
                'type' => 'Error',
                'value' => $admin
            ));
        }
    }

    $data = array(
        'title' => 'Login',
    );

    return $app['twig']->render('login.twig',$data);
})
->bind('login');


// Update snippet
$app->match('/admin/snippet/update/{snippet}', function (Request $request, $snippet)
{
    global $app;
    global $snippets_model;
    global $categories_model;

    if(!$app['session']->get('admin')) // Si pas connecté
        return $app->redirect($app['url_generator']->generate('login')); // Redirection vers login

    if($_POST){
        $form = array( 
            'id' => (int)$request->get('id'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'category' => (int)$request->get('category')
        );

        $constraint = new Assert\Collection(array( 
            'id' => array(new Assert\NotBlank()),
            'title' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 4))),
            'content' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 10))),
            'category' => array(new Assert\NotBlank(), new Assert\Type(array('type'=> 'integer')))
        ));

        $errors = $app['validator']->validateValue($form, $constraint);

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Sinon
            $updated = $snippets_model->update($form); 
            if($updated === true){ 
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Success',
                    'value' => 'Snippet updated !'
                ));
            }
            else{ // Sinon afficher erreur
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $updated
                ));
            }
        }
    }

    $snippets = $snippets_model->get($snippet);

    if(!$snippets)
        $app->abort(404, 'Oh sorry, page doesn\'t exist.'); 

    $data = array(
        'title' => 'Update Snippet',
        'snippet' => $snippets,
        'categories' => $categories_model->get()
    );

    return $app['twig']->render('admin/snippet.twig',$data);
})
->bind('admin/snippet/update')
->assert('id', '\d+');


// Delete snippet
$app->get('/admin/snippet/delete/{snippet}', function ($snippet)
{
    global $app;
    global $snippets_model;

    if(!$app['session']->get('admin')) // Si pas connecté
        return $app->redirect($app['url_generator']->generate('login')); // Redirection vers login

    $deleted = $snippets_model->delete($snippet);

    if($deleted === true){ 
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Success',
            'value' => 'Snippet deleted !'
        ));
    }
    else{ 
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => $deleted
        ));
    }

    return $app->redirect($app['url_generator']->generate('home'));
})
->bind('admin/snippet/delete')
->assert('snippet', '\d+');

// Add Category
$app->match('/admin/category', function (Request $request)
{
    global $app;
    global $categories_model;

    if(!$app['session']->get('admin')) // Si pas connecté
        return $app->redirect($app['url_generator']->generate('login')); // Redirection vers login

    if($_POST){
        $form = array( 
            'title' => $request->get('title')
        );

        $constraint = new Assert\Collection(array( 
            'title' => new Assert\NotBlank(),
        ));

        $errors = $app['validator']->validateValue($form, $constraint);

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Sinon
            $add = $categories_model->add($form);
            if($add === true){ 
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Success',
                    'value' => 'Category added !'
                ));
            }
            else{ // Sinon afficher erreur
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $add
                ));
            }
        }
    }

    return $app->redirect($app['url_generator']->generate('categories'));
});


// Delete category
$app->get('/admin/category/delete/{category}', function ($category)
{
    global $app;
    global $categories_model;

    if(!$app['session']->get('admin')) // Si pas connecté
        return $app->redirect($app['url_generator']->generate('login')); // Redirection vers login

    $deleted = $categories_model->delete($category);

    if($deleted === true){ 
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Success',
            'value' => 'Category deleted !'
        ));
    }
    else{ 
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => $deleted
        ));
    }

    return $app->redirect($app['url_generator']->generate('categories'));
})
->bind('admin/category/delete')
->assert('category', '\d+');


// Logout
$app->get('/admin/logout', function ()
{
    global $app;

    if($app['session']->get('admin')) // Si la session admin existe
        $app['session']->remove('admin'); // On la supprime pour déconnecter l'utilisateur

    return $app->redirect($app['url_generator']->generate('home'));
})
->bind('admin/logout');

// Errors
$app->error(function (\Exception $e, $code)
{
    global $app;

    $message = $e->getMessage() ?: 'The requested page could not be found.';

    $data = array(
        'title' => 'Error',
        'message' => $message
    );

    return $app['twig']->render('404.twig', $data);
});

$app->run();
