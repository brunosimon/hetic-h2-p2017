<?php

require('config.php');
use Symfony\Component\HttpFoundation\Request;

$app->before(function () use ($app) {
  $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));
});

// **** HOME
$app->get('/', function() use($app, $snippets_model) {
  $data = array(
    'title' => 'Home',
    'snippets' => $snippets_model->get(),
    'categories' =>$snippets_model->getCategories(),
    'pages' => $snippets_model->getPages()
  );

  return $app['twig']->render('home.twig',$data);
})
->bind('home');

// **** PAGES
$app->get('/page/{page}', function($page) use($app, $snippets_model) {
  $data = array(
    'title' => 'Page',
    'page' => (int)$page,
    'snippets' => $snippets_model->getByPage($page),
    'categories' =>$snippets_model->getCategories(),
    'pages' => $snippets_model->getPages($page)
  );
  return $app['twig']->render('page.twig',$data);
})
->assert('page','\d+')
->bind('page');

// **** CATEGORIES
$app->get('/category/{category}', function($category) use($app, $snippets_model) {
  $data = array(
    'title' => 'Category',
    'category' => $category,
    'snippets' => $snippets_model->getByCategorySlug($category),
    'categories' =>$snippets_model->getCategories()
  );
  return $app['twig']->render('category.twig',$data);
})
->assert('category','[a-z0-9-]+')
->bind('category');

// **** NEW SNIPPET
$app->match('/new', function(Request $request) use($app, $snippets_model) {
  $user = $app['session']->get('user');
  $data = array(
    'title' => 'New Snippet',
    'categories' => $snippets_model->getCategories()
  );

  if ($user === null)
    $data['error'] = "login";
  else {
    $dataSnippet = $request->request->all();
    if (!empty($dataSnippet)) {
      $dataSnippet['username'] = $user['username'];
      if (1 != $response = $snippets_model->create($dataSnippet)) {
         $data['success'] = [];
         $data['success']['errors'] = $response;
      }
      else
        $data['success'] = $response;
    }
  }
  return $app['twig']->render('new.twig',$data);
})
->method('GET|POST')
->bind('new');

// **** IMPROVE SNIPPET
$app->match('/improve/{id}', function(Request $request, $id) use($app, $snippets_model) {
  $user = $app['session']->get('user');
  $data = array(
    'title' => 'Improve Snippet',
    'categories' => $snippets_model->getCategories(),
    'snippet' => $snippets_model->getById((int)$id)['snippet'][0]
  );

  if ($user === null)
    $data['error'] = "login";
  else {
    $dataSnippet = $request->request->all();
    if (!empty($dataSnippet)) {
      $dataSnippet['username'] = $user['username'];
      if (1 != $response = $snippets_model->create($dataSnippet)) {
         $data['success'] = [];
         $data['success']['errors'] = $response;
      }
      else
        $data['success'] = $response;
    }
  }
  return $app['twig']->render('improve.twig',$data);
})
->method('GET|POST')
->assert('id','\d+')
->bind('improve');

// *** ONE SNIPPET
$app->get('/snippet/{id}', function($id) use($app, $snippets_model, $users_model) {
  $data = array(
    'title' => 'User',
    'snippet' => $snippets_model->getById((int)$id)['snippet'][0],
    'children' => $snippets_model->getById((int)$id)['children'],
    'categories' => $snippets_model->getCategories()
  );

  return $app['twig']->render('snippet.twig',$data);
})
->assert('id','\d+')
->bind('snippet');

// **** SEARCH SNIPPETS
$app->get('/search', function(Request $request) use($app, $snippets_model, $users_model) {
  $req = $request->query->all()['search'];
  if (!empty($req)) {
    $data = array(
      'title' => 'User',
      'snippets' => $snippets_model->search($req),
      'categories' => $snippets_model->getCategories()
    );
    return $app['twig']->render('search.twig',$data);
  }
  else {
    return $app->redirect($app["url_generator"]->generate("home"));
  }
})
->bind('search');


// ||||| USERS |||||
$app->get('/user/{username}', function($username) use($app, $snippets_model, $users_model) {
  $data = array(
    'title' => 'User',
    'snippets' => $snippets_model->getByUsername($username),
    'categories' => $snippets_model->getCategories(),
    'username' => $username
  );
  return $app['twig']->render('user.twig',$data);
})
->bind('user');

// **** LOGIN
$app->match('/login', function(Request $request) use($app, $snippets_model, $users_model) {
  $data = array(
    'title' => 'Login',
    'categories' =>$snippets_model->getCategories()
  );

  // Successfully logged in
  $dataUser = $request->request->all();
  if (!empty($dataUser)) {
    if ($users_model->login($dataUser)) {
      $app['session']->set('user', array('username' => $dataUser['username']));
      return $app->redirect($app["url_generator"]->generate("home"));
    }
    else
      $data['success'] = false;
  }

  return $app['twig']->render('login.twig',$data);
})
->method('GET|POST')
->bind('login');

// **** LOGOUT
$app->get('/logout', function() use($app) {
   $app['session']->clear();

   return $app->redirect($app["url_generator"]->generate("home"));
})
->bind('logout');

// **** SIGNUP
$app->match('/signup', function(Request $request) use($app, $snippets_model, $users_model) {
  $data = array(
    'title' => 'Login',
    'categories' =>$snippets_model->getCategories()
  );

  $dataUser = $request->request->all();
  if (!empty($dataUser)) {
    if (1 != $response = $users_model->create($dataUser)) {
       $data['success'] = [];
       $data['success']['errors'] = $response;
    }
    else
      $data['success'] = $response;
  }

  // display the form
  return $app['twig']->render('signup.twig', $data);
})
->method('GET|POST')
->bind('signup');

// *** ABOUT
$app->get('/about', function() use($app,$snippets_model) {
  $data = array(
    'title' => 'Abut FWS',
    'categories' =>$snippets_model->getCategories()
  );

  return $app['twig']->render('about.twig',$data);
})
->bind('about');

// ||||| ERRORS |||||
// Errors
$app->error(function (\Exception $e, $code) use($app, $snippets_model) {
  $data = array(
    'title' => 'Error: '.$code,
    'categories' =>$snippets_model->getCategories()
  );

  $app['twig']->addGlobal('layout', $app['twig']->loadTemplate('layout.twig'));

  if($code == 404)
    return $app['twig']->render('404.twig',$data);
});

$app->run();
