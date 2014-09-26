<?php
require_once('config.php');

use Symfony\Component\HttpFoundation\Request; // Must use it for the Request class
use Symfony\Component\Validator\Constraints as Assert; // Must use it for Validator

$app->get('/', function() use ($app, $snippets_model, $limit,  $users_model) {
    $data = array(
        'title'        => SITE_NAME,
        'active'       => 'home',
        'snippets'     => $snippets_model->get(),
	    'number_page'  => $snippets_model->get_number_page($limit),
        'categories'   => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('home.twig',$data);
})
->bind('home');

$app->get('/about', function() use ($app, $snippets_model, $limit,  $users_model) {
    $data = array(
        'title'        => SITE_NAME.' - About',
        'active'       => 'about',
        'categories'   => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('about.twig',$data);
})
->bind('about');

$app->get('/page/{page}', function($page) use ($app, $snippets_model, $limit,  $users_model) {
	$data = array(
	    'title'        => SITE_NAME.' - Page '.$page,
        'active'       => 'home',
	    'page'         => $page,
	    'snippets'     => $snippets_model->get_by_page($page,$limit),
	    'number_page'  => $snippets_model->get_number_page($limit),
        'categories'   => $snippets_model->get_categories(),
	);
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
	return $app['twig']->render('page.twig',$data);	
})
->assert('page','\d+') 
->bind('page');

$app->get('/categories', function() use ($app, $snippets_model, $limit,  $users_model) {
    $data = array(
        'title'       => SITE_NAME.' - Categories',
        'active'      => 'categories',
        'categories'  => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('categories.twig',$data);
})
->bind('categories');

$app->get('/category/{category}/page/{page}', function($category, $page) use ($app, $snippets_model, $limit,  $users_model) {
    $data = array(
        'title'        => SITE_NAME.' - '.$category.' Page '.$page,
        'active'       => $category,
        'category'     => $category,
	    'page'         => $page,
	    'snippets'     => $snippets_model->get_by_category_slug($category, $page),
	    'number_page'  => $snippets_model->get_number_page_by_category($limit, $category),
        'categories'   => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9]+')
->assert('page', '\d+')
->bind('page_category');

$app->get('/category/{category}', function($category) use ($app, $snippets_model, $limit,  $users_model) {
        $data = array(
        'title'        => SITE_NAME.' - '.$category,
        'active'       => $category,
        'category'     => $category,
        'snippets'     => $snippets_model->get_by_category_slug($category),
	    'number_page'  => $snippets_model->get_number_page_by_category($limit, $category),
        'categories'   => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+')  
->bind('category');

$app->match('/add', function(Request $request) use ($app, $snippets_model,  $users_model) {    
    $data = array(
        'title'       => SITE_NAME.' - Add snippet',
        'active'      => 'add',
        'categories'  => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    $form = $app['form.factory']->createBuilder('form')
        ->add('name')
        ->add('content', 'textarea')
        ->add('category', 'choice', array(
            'choices' => $snippets_model->get_categories_name(),
            'expanded' => false,
        ))
        ->getForm();
    
    $form->handleRequest($request);

    if ($form->isValid()) {
        $form_data = $form->getData();
                
        $title    = $form_data['name'];
        $content  = $form_data['content'];
        $id_category = $form_data['category'];
        
        $data['message'] = $snippets_model->add_snippet($title, $content, $id_category);
        
        
    }
    
    $data['form'] = $form->createView();
    return $app['twig']->render('add_snippet.twig',$data);
})
->bind('add_snippet');

$app->match('/contact', function(Request $request) use ($app, $snippets_model, $forms_model,  $users_model) {    
    $data = array(
        'title'       => SITE_NAME.' - Contact',
        'active'      => 'contact',
        'categories'  => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    $form = $app['form.factory']->createBuilder('form')
        ->add('subject')
        ->add('from', 'email', array(
            'constraints' => new Assert\Email()
        ))
        ->add('content', 'textarea')
        ->getForm();
    
    $form->handleRequest($request);

    if ($form->isValid()) {
        $form_data = $form->getData();
        
        $subject = $form_data['subject'];
        $from = $form_data['from'];
        $content = $form_data['content'];
        $data['message'] = $forms_model->send_message($subject, $from, $content);
    }
    
    $data['form'] = $form->createView();
    return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

/***************** SIGN IN AND SIGN UP *******************/

$app->match('/signup', function(Request $request) use ($app, $snippets_model, $users_model){
    $data = array (
        'title'       => SITE_NAME.' - Sign Up',
        'active'      => 'signup',
        'categories'  => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    /* *** Creating form *** */
    
    $form = $app['form.factory']->createBuilder('form')
        ->add('email', 'email', array(
                'constraints' => new Assert\Email(),
                /*'label'  => 'Email',
                'attr' => array('placeholder' => 'Email')*/
        ))
        ->add('pseudo', 'text', array (
            'max_length' => 20
        ))
        ->add('password', 'repeated', array(
            'type' => 'password',
            'invalid_message' => 'The password fields must match.',
            'first_options'  => array('label' => 'Password'),
            'second_options' => array('label' => 'Repeat Password'),
        ))
        ->getForm();
    
    /* *** Checking form *** */
    
    $form->handleRequest($request);
    
    if($form->isValid()){
        $form_data = $form->getData();
        
        $email = $form_data['email'];
        $pseudo = $form_data['pseudo'];
        $password = $form_data['password'];

        $data['message'] = $users_model->add($email, $pseudo, $password);
    }    
    
    $data['form'] = $form->createView();
    return $app['twig']->render('signup.twig',$data);
})
->bind('signup');


$app->match('/signin', function(Request $request) use ($app, $snippets_model, $users_model){
    $data = array (
        'title'       => SITE_NAME.' - Sign In',
        'active'      => 'signin',
        'categories'  => $snippets_model->get_categories(),
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    /* *** Creating form *** */
    
    $form = $app['form.factory']->createBuilder('form')
        ->add('pseudo', 'text', array (
            'max_length' => 20
        ))
        ->add('password', 'password', array(
        ))
        ->getForm();
    
    /* *** Checking form *** */
    
    $form->handleRequest($request);
    
    if($form->isValid()){
        $form_data = $form->getData();
        
        $pseudo = $form_data['pseudo'];
        $password = $form_data['password'];

        $data['message'] = $users_model->connect($pseudo, $password);
    }    
    
    $data['form'] = $form->createView();
    return $app['twig']->render('signin.twig',$data);
})
->bind('signin');

$app->get('/signout', function() use ($app, $snippets_model, $users_model) {
    $data = array (
        'title'       => SITE_NAME.' - Snippet',
        'active'      => 'user',
        'categories'  => $snippets_model->get_categories(),
    );
    
    if ($users_model->check_connected()){
        $users_model->log_out();
        $data['message'] =  "You are now log out, see you soon !";
    }else {
        $data['message'] =  "Sorry you are not connected...";
    }
    
    return $app['twig']->render('signout.twig', $data);
})
->bind('signout');

$app->get('/snippet/{id}', function($id) use ($app, $snippets_model,  $users_model) {
    $data = array (
        'title'       => SITE_NAME.' - Snippet',
        'active'      => 'home',
        'categories'  => $snippets_model->get_categories(),
        'snippet'     => $snippets_model->get_snippet($id)
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('snippet.twig', $data);
})
->assert('id', '\d+')
->bind('snippet');

$app->get('/delete/{id}', function($id) use ($app, $snippets_model,  $users_model) {
    $data = array (
        'title'       => SITE_NAME.' - Delete',
        'active'      => 'home',
        'categories'  => $snippets_model->get_categories(),
        'message'     => $snippets_model->delete_snippet($id)
    );
    if ($users_model->check_connected()){
        $data['connected'] = true;
    }
    return $app['twig']->render('delete.twig', $data);
})
->assert('id', '\d+')
->bind('delete');

$app->run();

