<?php
use Symfony\Component\HttpFoundation\Request;
require 'config.php';

// HOME
$app->get('/', function()
{
    global $app;
    global $snippets_model;

    $data = array(
    	'title' 	=> 'Home',
    	'snippets' 	=> $snippets_model->get (),
    );

    return $app['twig']->render('home.twig', $data);
})
->bind('home');

// SUGGEST
$app->match('/suggest',function(Request $request){
 global $app;
 global $snippets_model;
 global $category_model;
 global $pdo;

 $form = $app['form.factory']->createBuilder('form')
  ->add('Name')
  ->add('Recipe')
  ->getForm();

 $form->handleRequest($request);

 if($form->isValid()){
  $data = $form->getData();
  echo '<pre>';
  print_r($data);
  print_r($_POST['categ']);
  print_r($_POST['submit']);
  echo '</pre>';

   $prepare = $pdo->prepare('INSERT INTO snippets (title,content,id_category) VALUES (:title,:content,:id_category)');
    $prepare->bindValue(':title',$data['Name']);
    $prepare->bindValue(':content',$data['Recipe']);
    $prepare->bindValue(':id_category',$_POST['categ']);
    $exec = $prepare->execute();

    echo '<pre>';
    print_r($exec);
    echo '</pre>';
    exit;
die('ok');
    header('location: categories');

  exit;
 }

 $data = array(
  'title' => 'Suggest',
  'form'  => $form->createView(),
  'categories' => $category_model->get(),
 );

 return $app['twig']->render('suggest.twig',$data);
})
->bind('suggest');

// ABOUT
$app->get('/about/', function()
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'     => 'About',
        'snippets'  => $snippets_model->get (),
    );

    return $app['twig']->render('about.twig', $data);
})
->bind('about');


// HOME
$app->get('/allrecipies/', function()
{
    global $app;
    global $snippets_model;


    $data = array(
      'title'   => 'All Recipies',
      'snippets'  => $snippets_model->get (),
    );

    return $app['twig']->render('allrecipies.twig', $data);
})
->bind('allrecipes');


// CONTACT
$app->match('/contact/',function(Request $request){
 global $app;
 global $pdo;

 $form = $app['form.factory']->createBuilder('form')
  ->add('nom')
  ->add('email')
  ->add('message','textarea')
  ->getForm();

 $form->handleRequest($request);

 if($form->isValid()){
  $data = $form->getData();
  echo '<pre>';
  print_r($data);
  print_r($_POST['submit']);
  echo '</pre>';

  mail('simon.bruno.77@gmail.com', $data['nom'].' vous a laissé un message.' , "Envoyé par :".$data['email']." Message :".$data['message']);

  header('location: ../categories');

  exit;
 }

 $data = array(
  'title' => 'Contact',
  'form'  => $form->createView(),
 );

 return $app['twig']->render('contact.twig',$data);
})
->bind('contact');
// PAGE
$app->get('/page/{page}', function($page)
{
	global $app;
	global $snippets_model;
	$data = array(
    	'title' => 'Page',
    	'snippets' 	=> $snippets_model->get_by_page($page),
    );
    return $app['twig']->render('page.twig', $data);
})
->assert('page','\d+')
->bind('page');

// CATEGORIES
$app->get('/categories', function()
{
 global $app;
 global $category_model;

 $data = array(
  'title' => 'Categories',
  'categories' => $category_model->get(),
 );

    return $app['twig']->render('categories.twig',$data);
})
->bind('categories');

// CATEGORY
$app->get('/category/{category}',function($category)
{
	global $app;
	global $snippets_model;

	$data = array(
    	'title' => 'Category',
    	'snippets' 	=> $snippets_model->get_by_category_slug($category),
    );
    return $app['twig']->render('category.twig', $data);
})
->assert('category','[a-z0-9-]+')
->bind('category');



$app->run();


