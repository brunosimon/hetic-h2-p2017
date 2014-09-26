<?php

require 'config.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\Constraints as Assert;

/* ---------------------------------------------------
*
* Home
*
* -------------------------------------------------- */

$app->get('/',function() use ($app, $snippets_model)
{

    $data = array(
        'title'    => 'Home',
        'snippets' => $snippets_model->get(),
        'pages' => $snippets_model->get_pages(1),
        'current' => 1
    );

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

/* ---------------------------------------------------
*
* Snippet
*
* -------------------------------------------------- */

/* ---------- Snippets page ---------- */

$app->get('/page/{page}', function($page) use ($app, $snippets_model)
{
    $exec = $snippets_model->get_by_page($page); // On récupère les snippets de la page passé en paramètre.

    if($exec === false) // Si la page passé en parametre n'existe pas.
        $app->abort(404, 'Page not found.'); 

    $data = array(
        'title'    => 'Page',
        'snippets' => $exec, // On envoi la liste des snippets.
        'pages' => $snippets_model->get_pages($page), // On envoi le nombre de pages pour la pagination.
        'current' => $page // Page actuelle
    );

    return $app['twig']->render('home.twig',$data);
})
->bind('page')
->assert('page','\d+')
->value('page', 1);

/* ---------- Snippet ---------- */

$app->get('/snippet/{snippet}', function($snippet) use ($app, $snippets_model)
{
    $exec = $snippets_model->get($snippet); // On récupère le snippet.

    if($exec === false) // Si le snippet passé en parametre n'existe pas.
        $app->abort(404, "Snippet not exist."); // On envoi une page 404 avec un message personnalisé.

    $data = array(
        'title'    => $exec['title'],
        'snippet' => $exec // On envoi le snippet à la vue.
    );

    return $app['twig']->render('snippet.twig',$data);
})
->bind('snippet')
->assert('snippet', '\d+');

/* ---------- Search ---------- */

$app->get('search/{q}/{page}', function($q, $page) use ($app, $snippets_model)
{
    $snippets = $snippets_model->get_by_title($q, $page);

    // Prepare data
    $data = array(
        'title'    => 'Search : '.$q,
        'snippets' => $snippets,
        'pages'    => $snippets_model->get_pages($page, 4, '.', $q),
        'q'        => $q,
        'current'  => $page
    );

    return $app['twig']->render('home.twig', $data);
})
->bind('search')
->assert('page','\d+')
->assert('q','[a-zA-Z0-9]+')
->value('page',1);

/* ---------- Add snippet ---------- */

$app->match('/add', function(Request $request) use ($app, $snippets_model, $categories_model)
{
    if($_POST){
        $form = array( // On récupère les valeurs envoyés par le formulaire.
            'title' => $request->get('title'),
            'content' => htmlspecialchars(trim($request->get('content'))),
            'category' => (int)$request->get('category')
        );

        $constraint = new Assert\Collection(array( // On affecte des contraintes pour la validation des champs du formulaire.
            'title' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 4))),
            'content' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 10))),
            'category' => array(new Assert\NotBlank(), new Assert\Type(array('type'=> 'integer')))
        ));

        $errors = $app['validator']->validateValue($form, $constraint); // On vérifie que les champs soient correctes, si erreur(s) on les stockes dans $errors.

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array( // On crée un message flash d'erreur dans notre session
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Si pas d'erreur
            $exec = $snippets_model->add($form); // On ajoute le snippet
            if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
                $app['session']->getFlashBag()->add('message', array( // On crée un message flash de succès dans notre session
                    'type' => 'Success',
                    'value' => 'Snippet send to validation !'
                ));
            }
            elseif($exec === NULL){ // Si erreur BDD
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => 'Bdd error'
                ));
            }
            else{ // Sinon afficher erreur
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $exec
                ));
            }
        }
    }

    $data = array(
        'title'    => 'Add snippet',
        'categories' => $categories_model->get('active') // On envoi les catégories à la vue.
    );

    return $app['twig']->render('add.twig', $data);
})
->bind('add');

/* ---------- Snippets by category ---------- */

$app->get('/category/{category}/{page}', function($category, $page) use ($app, $categories_model, $snippets_model)
{
    $is_category = $categories_model->get($category);

    if(!$is_category)
        $app->abort(404, "Category not found.");

    $exec = $snippets_model->get_by_category_slug($category, $page);

    $data = array(
        'title'    => ucfirst($category),
        'snippets' => $exec, // On renvoi la liste des snippets
        'pages' => $snippets_model->get_pages($page, 4, $category), // On renvoi le nombre de page
        'current' => $page, // Page actuelle
        'category' => $category // Categorie actuelle
    );

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+')
->assert('page','\d+')
->value('page', 1);

/* ---------------------------------------------------
*
* Categories
*
* -------------------------------------------------- */

$app->get('/categories', function() use ($app, $categories_model)
{
    $data = array(
        'title'    => 'Categories',
        'categories' => $categories_model->get('active') // On récupère la liste des catégories.
    );

    return $app['twig']->render('categories.twig',$data);
})
->bind('categories');

/* ---------------------------------------------------
*
* Contact
*
* -------------------------------------------------- */

/* ---------- Form contact ---------- */

$app->match('/contact', function(Request $request) use ($app)
{
    if($_POST){
        $form = array( // On récupère les informations du formulaire de contact
            'email' => $request->get('email'),
            'content' => htmlspecialchars(trim($request->get('content')))
        );

        $constraint = new Assert\Collection(array( // On affecte des contraintes pour la validation des champs du formulaire.
            'email' => array(new Assert\NotBlank(), new Assert\Email()),
            'content' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 10)))
        ));

        $errors = $app['validator']->validateValue($form, $constraint); // On vérifie que les champs soient correctes, si erreur(s) on les stockes dans $errors.

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Si pas d'erreurs
            $message = \Swift_Message::newInstance() // On utilise de le service de mail de Silex pour envoyer notre mail
                ->setSubject('[Snippet] Contact') // Sujet
                ->setFrom($form['email']) // From
                ->setReplyTo($form['email']) // Reply to
                ->setTo('guillaumejuvenet@gmail.com') // Envoyé à
                ->setBody('Message de ' . $form['email'] . ' : ' .  $form['content']); // Message

            $app['mailer']->send($message); // Envoi du mail
            $app['session']->getFlashBag()->add('message', array( // On affiche un message de succès.
                'type' => 'Success',
                'value' => 'Message send !'
            ));
        }
    }

    $data = array(
        'title' => 'Contact'
    );

    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

/* ---------------------------------------------------
*
* About
*
* -------------------------------------------------- */

$app->get('/about', function() use ($app, $pages_model)
{
    $data = array(
        'title' => 'About',
        'page' => $pages_model->get('about') // On récupère le contenu de la page about.
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about');

/* ---------------------------------------------------
*
* Administration
*
* -------------------------------------------------- */

/* ---------- Login ---------- */

$app->match('/login', function(Request $request) use ($app, $admins_model)
{
    if($app['session']->get('admin')) // Si déjà loggé
        return $app->redirect($app['url_generator']->generate('admin')); // On redirige vers la page admin.

    if($_POST){
        $form = array( // On récupère les valeurs entrées dans le formulaire de connexion.
            'username' => strtolower($request->get('username')),
            'password' => $request->get('password')
        );

        $exec = $admins_model->is_admin($form); // On vérifie que les informations entrées sont correctes.

        if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
            $app['session']->set('admin', array('username' => $form['username']));

            return $app->redirect($app['url_generator']->generate('admin')); // On redirige vers l'admin
        }
        elseif($exec === NULL){ // Si erreur BDD
            $app['session']->getFlashBag()->add('message', array(
                'type' => 'Error',
                'value' => 'Bdd error'
            ));
        }
        else{ // Sinon afficher erreur
            $app['session']->getFlashBag()->add('message', array(
                'type' => 'Error',
                'value' => $exec
            ));
        }
    }

    $data = array(
        'title' => 'Login',
        'admin' => $app['session']->get('admin')
    );

    return $app['twig']->render('login.twig',$data);
})
->bind('login');

/* ---------- Admin ---------- */

$app->get('/admin', function () use ($app, $admins_model, $snippets_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    $data = array(
        'title' => 'Admin',
        'admin' => $app['session']->get('admin'),
        'snippets' => $snippets_model->get('all') // On récupère l'ensemble des snippets.
    );

    return $app['twig']->render('admin/admin.twig',$data);
})
->bind('admin');

/* ---------- Pages ---------- */

$app->match('/admin/pages', function (Request $request) use ($app, $pages_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    if($_POST){
        $form = array( // On récupère les données entrées dans le formulaire.
            'page' => $request->get('page')
        );

        $exec = $pages_model->update($form); // Mise à jour des pages.

        if(!in_array(0, $exec)){ // Si la requête bdd n'emet pas d'erreurs.
            $app['session']->getFlashBag()->add('message', array(
                'type' => 'Success',
                'value' => 'Page(s) updated !'
            ));
        }
        else{ // Si erreur BDD
            $app['session']->getFlashBag()->add('message', array(
                'type' => 'Error',
                'value' => 'Bdd error'
            ));
        }
    }

    $data = array(
        'title' => 'Pages',
        'admin' => $app['session']->get('admin'),
        'pages' => $pages_model->get() // On récupère les pages.
    );

    return $app['twig']->render('admin/pages.twig',$data);
})
->bind('admin/pages');

/* ---------- Categories ---------- */

$app->match('/admin/categories', function (Request $request) use ($app, $categories_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    if($_POST){
        $form = array( // On récupère les informations entrées dans le formulaire.
            'title' => $request->get('title'),
            'slug' => $request->get('title')
        );

        $search = array('È˜', 'Èš', 'ÅŸ', 'Å£', 'Åž', 'Å¢', 'È™', 'È›', 'Ã®', 'Ã¢', 'Äƒ', 'ÃŽ', 'Ã‚', 'Ä‚', 'Ã«', 'Ã‹', 'ç');
        $replace = array('s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E', 'c');
        $form['slug'] = str_ireplace($search, $replace, strtolower(trim($form['slug'])));
        $form['slug'] = preg_replace('/[^\w\d\-\ ]/', '', $form['slug']);
        $form['slug'] = str_replace(' ', '-', $form['slug']);
        $form['slug'] = preg_replace('/\-{2,}/', '-', $form['slug']);

        $constraint = new Assert\Collection(array( // On affecte des contraintes pour la validation des champs du formulaire.
            'title' => array(new Assert\NotBlank()),
            'slug' => array(new Assert\NotBlank())
        ));

        $errors = $app['validator']->validateValue($form, $constraint); // On vérifie que les champs soient correctes, si erreur(s) on les stockes dans $errors.

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else { // Si pas d'erreurs
            $exec = $categories_model->add($form); // On ajoute la catégorie
            if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Success',
                    'value' => 'Category added !'
                ));
            }
            elseif($exec === NULL){ // Si erreur BDD
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => 'Bdd error'
                ));
            }
            else{ // Sinon afficher erreur
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $exec
                ));
            }
        }
    }

    $data = array(
        'title' => 'Categories',
        'admin' => $app['session']->get('admin'),
        'categories' => $categories_model->get('all') // On récupère toutes les catégories.
    );

    return $app['twig']->render('admin/categories.twig',$data);
})
->bind('admin/categories');


/* ---------- Delete category ---------- */

$app->get('/admin/category/delete/{category}', function ($category) use ($app, $categories_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    $exec = $categories_model->delete((int)$category); // Supprimer une catégorie

    if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Success',
            'value' => 'Category deleted !'
        ));
    }
    elseif($exec === NULL){ // Si erreur BDD
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => 'Bdd error'
        ));
    }
    else{ // Sinon afficher erreur
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => $exec
        ));
    }

    return $app->redirect($app['url_generator']->generate('admin/categories'));
})
->bind('admin/category/delete')
->assert('category', '\d+');

/* ---------- Active category ---------- */

$app->get('/admin/category/active/{category}/{active}', function ($category, $active) use ($app, $categories_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    $exec = $categories_model->active((int)$category, $active); // Active category

    if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Success',
            'value' => 'Category status changed !'
        ));
    }
    elseif($exec === NULL){ // Si erreur BDD
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => 'Bdd error'
        ));
    }
    else{ // Sinon afficher erreur
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => $exec
        ));
    }

    return $app->redirect($app['url_generator']->generate('admin/categories'));
})
->bind('admin/category/active')
->assert('category', '\d+')
->assert('active', '[0-1]');

/* ---------- Update snippet ---------- */

$app->match('/admin/snippet/{id}', function (Request $request, $id) use ($app, $snippets_model, $categories_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    if($_POST){
        $snippet = array( // On récupère les entrées du formulaire.
            'id' => (int)$request->get('id'),
            'title' => $request->get('title'),
            'content' => $request->get('content'),
            'category' => (int)$request->get('category')
        );

        $constraint = new Assert\Collection(array( // On affecte des contraintes pour la validation des champs du formulaire.
            'id' => array(new Assert\NotBlank()),
            'title' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 4))),
            'content' => array(new Assert\NotBlank(), new Assert\Length(array('min' => 10))),
            'category' => array(new Assert\NotBlank(), new Assert\Type(array('type'=> 'integer')))
        ));

        $errors = $app['validator']->validateValue($snippet, $constraint); // On vérifie que les champs soient correctes, si erreur(s) on les stockes dans $errors.

        if (count($errors) > 0) { // Si des erreurs
            foreach ($errors as $error) {
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $error->getPropertyPath().' '.$error->getMessage()
                ));
            }
        } else {
            $exec = $snippets_model->update($snippet); // Update du snippet
            if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Success',
                    'value' => 'Snippet updated !'
                ));
            }
            elseif($exec === NULL){ // Si erreur BDD
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => 'Bdd error'
                ));
            }
            else{ // Sinon afficher erreur
                $app['session']->getFlashBag()->add('message', array(
                    'type' => 'Error',
                    'value' => $exec
                ));
            }
        }
    }

    $data = array(
        'title' => 'Update Snippet',
        'admin' => $app['session']->get('admin'),
        'snippet' => $snippets_model->get($id, 1),
        'categories' => $categories_model->get('all')
    );

    return $app['twig']->render('admin/snippet.twig',$data);
})
->bind('admin/snippet')
->assert('id', '\d+');

/* ---------- Delete snippet ---------- */

$app->get('/admin/snippet/delete/{snippet}', function ($snippet) use ($app, $snippets_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    $exec = $snippets_model->delete($snippet);

    if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Success',
            'value' => 'Snippet deleted !'
        ));
    }
    elseif($exec === NULL){ // Si erreur BDD
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => 'Bdd error'
        ));
    }
    else{ // Sinon afficher erreur
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => $exec
        ));
    }

    return $app->redirect($app['url_generator']->generate('admin'));
})
->bind('admin/snippet/delete')
->assert('snippet', '\d+');

/* ---------- Active snippet ---------- */

$app->get('/admin/snippet/active/{snippet}/{active}', function ($snippet, $active) use ($app, $snippets_model)
{
    if(!$app['session']->get('admin')) // Si pas loggé
        return $app->redirect($app['url_generator']->generate('login')); // On redirige vers la page de login.

    $exec = $snippets_model->active($snippet, $active); // On change le statut du snippet.

    if($exec === true){ // Si la requête bdd n'emet pas d'erreurs.
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Success',
            'value' => 'Snippet status changed !'
        ));
    }
    elseif($exec === NULL){ // Si erreur BDD
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => 'Bdd error'
        ));
    }
    else{ // Sinon afficher erreur
        $app['session']->getFlashBag()->add('message', array(
            'type' => 'Error',
            'value' => $exec
        ));
    }

    return $app->redirect($app['url_generator']->generate('admin'));
})
->bind('admin/snippet/active')
->assert('snippet', '\d+')
->assert('active', '[0-1]');

/* ---------- Logout ---------- */

$app->get('/admin/logout', function () use ($app)
{
    if($app['session']->get('admin')) // Si la session admin existe
        $app['session']->remove('admin'); // On la supprime pour déconnecter l'utilisateur.

    return $app->redirect($app['url_generator']->generate('home'));
})
->bind('admin/logout');

/* ---------------------------------------------------
*
* Error
*
* -------------------------------------------------- */

$app->error(function (\Exception $e, $code) {
    switch ($code) {
        case 404:
            $message = $e->getMessage() ?: 'The requested page could not be found.';
            break;
        default:
            $message = $e->getMessage() ?: 'We are sorry, but something went terribly wrong.';
    }

    return new Response($message);
});

// ---->

$app->run();