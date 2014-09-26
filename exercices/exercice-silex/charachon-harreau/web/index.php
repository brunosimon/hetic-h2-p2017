<?php

require_once'config.php';
use Symfony\Component\HttpFoundation\Request;

// Accueil
$app->get('/', function()
{
	global $app;
	global $snippets_model;
	global $page;

	$data = array(
		'title' => 'Home',
		'snippets' => $snippets_model->get(),
		'pages' => $snippets_model->get_pages($page)
	);

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

// About
$app->get('/about', function()
{
    global $app;
    global $snippets_model;

	$data = array(
		'title' => 'About',
	);

    return $app['twig']->render('about.twig',$data);
})
->bind('about');


// Page
$app->get('/page/{page}', function($page)
{
    global $app;
    global $snippets_model;


	$data = array(
		'title' => 'Page',
		'snippets' => $snippets_model->get_by_page($page),
		'pages' => $snippets_model->get_pages($page)
	);

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

// Category Accueil
$app->get('/category', function()
{
    global $app;
    global $snippets_model;

    $data = array(
        'title' => 'Category_accueil',
        'snippets' => $snippets_model->get_all_categories(),
    );

    return $app['twig']->render('category_accueil.twig',$data);
})
->bind('category_accueil')
->assert('category','[a-z0-9-]+');


// Category
$app->get('/category/{category}', function($category)
{
    global $app;
    global $snippets_model;
    global $page;

	$data = array(
		'title' => 'Category',
		'snippets' => $snippets_model->get_by_category_slug($category),
		'pages' => $snippets_model->get_pages_category(1,$category)
	);

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

// Category Pagination
	$app->get('/category/{category}/page/{page}', function($category,$page){
	    global $app;
	    global $snippets_model;

	    $data = array (
			'title'   => 'Category',
			'snippets'=> $snippets_model->get_by_category_slug($category,$page),
			'pages'   => $snippets_model->get_pages_category($page,$category),
		);

	    return $app['twig']->render('category.twig',$data);
	})
	->bind('category_pagination')
	->assert('category','[a-z0-9-]+')
	->assert('page','\d+');

//Add snippet
$app->match('/suggest', function(Request $request)
{
    global $app;
    global $snippets_model;
    global $pdo;

    $form = $app['form.factory']->createBuilder('form')
        ->add('title')
        ->add('category', 'choice', array(
            'choices' => array(1 => 'Reaction Faces', 2 => 'Fail', 3 => 'Weird', 4 => 'Film'),
            'required'    => true,
            'empty_value' => 'Select the category',
            'empty_data'  => null
        ))
        ->add('content','textarea')
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        if (preg_match('/.gif$/', $data['content'])){
        // echo'<pre>';
        // print_r($data);
        // echo'</pre>';

        // echo'<pre>';
        // print_r($data['title']);
        // echo'</pre>';

        // do something with the data
        $prepare = $pdo->prepare('
            INSERT INTO snippets (title,id_category,content) VALUES (:title,:category,:content)
        ');
        $prepare->bindValue(':title', $data['title']);
        $prepare->bindValue(':category', $data['category']);
        $prepare->bindValue(':content', $data['content']);
        $prepare->execute();
        $results = $prepare->fetchAll();
        $data['success'] = true; //permet d'afficher le bon envoi du snippet

        // redirect somewhere
        return $app->redirect('/');

		}
		else {
			echo "Uniquement les gifs sont acceptés";
		}
    }

    $data = array(
        'title' => 'Suggest',
        'form' => $form->createView()
    );

    return $app['twig']->render('suggest.twig',$data);
})
->bind('suggest');

//Contact
$app->match('/contact', function(Request $request)
{
    global $app;
    global $snippets_model;


    $form = $app['form.factory']->createBuilder('form')
        ->add('subject')
        ->add('mail')
        ->add('content','textarea')
        ->getForm();

    $form->handleRequest($request);

    if ($form->isValid()) {
        $data = $form->getData();

        // do something with the data
        $to      = 'bruno.simon@hetic.net';
        $subject = $data['subject'];
        $message = $data['content'];

        mail($to, $subject, $message);

        $data['success'] = true; //permet d'afficher le bon envoi du snippet
    }

    $data = array(
        'title' => 'Suggest',
        'form' => $form->createView()
    );

    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

//admin

$app->match('/admin', function(Request $request)
{
    global $app;
    global $snippets_model;

    $form = $app['form.factory']->createBuilder('form')
        ->add('login')
        ->add('password','password')
        ->getForm();

    $form->handleRequest($request);



    if ($form->isValid()) {
    	$data = $form->getData();

    	// connection TEST

    	if (($data['login'] == "Chuck") && ($data['password'] == "Norris")) {
    		$app['session']->set('Connected', true);
    	}

    }

    if (!empty($_GET)){
    	$admindata = array(
    	'snippets'=> $snippets_model->action_admin()
    	);
    	};

    $data = array(
        'title' => 'Admin',
        'snippets'=> $snippets_model->get_all_post(),
        'form' => $form->createView()
    );

    return $app['twig']->render('admin.twig',$data);
})

->bind('admin');


$app->run();
