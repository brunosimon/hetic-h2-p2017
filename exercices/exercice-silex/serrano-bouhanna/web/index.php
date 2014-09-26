<?php

require('config.php');
use Symfony\Component\HttpFoundation\Request;


// HOME
$app->get('/', function() use($app, $snippets_model) {

  $data = array(
    'title' => 'Home',
    'categories' => $snippets_model->top()
  );

  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
      );
  }

  return $app['twig']->render('home.twig',$data);
})
->bind('home');

// CATEGORIES
$app->get('/category/{category}/{id}', function($category, $id) use($app, $snippets_model) {

  $data = array(
    'title'    => 'Category',
    'category' => $category,
    'snippets' => $snippets_model->getByPage($id, 3, $category),
    'pages'    => $snippets_model->get_pages_slug(1, 3, $category)
    
  );

  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
    );
  }
  return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+')
->bind('category');

// NEW SNIPPET
$app->get('/new', function() use($app, $snippets_model) {
  $user = $app['session']->get('user');
  if ($user !== null) {
    $data = array(
      'title' => 'New Snippet',
      'categories' => $snippets_model->getCategories()
    );
    if (null !== $user = $app['session']->get('user')) {
      $data['logged'] = true;
      $data['user'] = array(
          'username' => $user['username'],
          'id' => $user['id']
        );
    }
    return $app['twig']->render('new.twig',$data);
  }
  else {
    return $app->redirect($app["url_generator"]->generate("home"));
  }
})
->bind('new');

$app->post('/createsnippet', function(Request $request) use($app, $snippets_model, $users_model) {
  $user = $app['session']->get('user');

  if ($user !== null) {
    $dataSent = $request->request->all();
    $dataSent['user'] = $users_model->getByName($user['username'])[0]['id'];

    $create = $snippets_model->create($dataSent);

    if ($create == 1)
      return $app->redirect($app["url_generator"]->generate("home"));
    else
      return $app->redirect($app["url_generator"]->generate("new"));
    return 'ok';
  }
  else 
    return $app->redirect($app["url_generator"]->generate("home"));
})
->bind('createsnippet');

//SIGNUP
$app->get('/signup', function() use($app) {
  $data = array(
    'title' => 'Signup'
  );
  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
      );
  }
  return $app['twig']->render('signup.twig',$data);
})
->bind('signup');

$app->get('snippet/{id}', function($id) use ($app, $snippets_model){

  $data = array (
    'title' => 'Snippet',
    'snippet' => $snippets_model->select_one_snippet($id)
  );

  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
      );
  }

  return $app['twig']->render('snippet.twig',$data);
})
->bind('snippet');


$app->post('/createuser', function(Request $request) use($app, $users_model) {
  $data = $request->request->all();
  
  $create = $users_model->create($data);
  
  if ($create == 1)
    return $app->redirect($app["url_generator"]->generate("login"));
  else
    return $app->redirect($app["url_generator"]->generate("signup"));

})
->bind('createuser');

//LOGIN
$app->get('/login', function() use($app) {
  $data = array('title' => 'Login');
  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
      );
  }
  return $app['twig']->render('login.twig',$data);
})
->bind('login');

$app->post('/checklogin', function(Request $request) use($app, $users_model) {
  $dataSent = $request->request->all();

  $check = $users_model->login($dataSent);
  
  $data = array(
    'title' => 'Login',
    'logged' => false
    );
  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
      );
  }
  if ($check) {
    $userId = $users_model->getByName($dataSent['username'])[0]['id'];

    $app['session']->set('user', array('username' => $dataSent['username'], 'id' => $userId));
    $data['logged'] = true;
    $data['username'] = $dataSent['username'];
  }

  return $app['twig']->render('login.twig',$data);
})
->bind('checklogin');

//LOG OUT
$app->get('/logout', function() use($app) {
   $app['session']->clear();

   return $app->redirect($app["url_generator"]->generate("home"));
})
->bind('logout');

// ABOUT
$app->get('/about', function() use($app) {
  $data = array('title' => 'About Us');
  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
      );
  }
  return $app['twig']->render('about.twig',$data);
})
->bind('about');

// CONTACT
$app->match('/contact', function(Request $request) use($app, $contact_model) {

  $data = array('title' => 'Contact Us' );
  $form = array();

  if (null !== $user = $app['session']->get('user')) {
    $data['logged'] = true;
    $data['user'] = array(
        'username' => $user['username'],
        'id' => $user['id']
    );
    $form['name'] = $user['username'];
  }

  if($request->getMethod() == 'POST'){
    $form = array (
      'name' => $request->get('name'),
      'to' => $request->get('mail'),
      'message' => $request->get('content')
    );

    $contact_model->seed($form);
  }
  return $app['twig']->render('contact.twig',$data);
})
->bind('contact');

$app->run();


/*
• Pagination
• Liste de categories (cliquables)
• Soumettre un snippet
• About
• Contact
• Design Bootstrap
*/