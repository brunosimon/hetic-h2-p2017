<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
require_once 'config.php';

/**
 * HOME
 */
$app->get('/', function()
{
    global $app;
    global $quotes_model;

    $data = array(
        'quotes'     => $quotes_model->get_all_quotes(),
        'promotions' => $quotes_model->get_all_promotions()
    );

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

/**
 * ABOUT
 */
$app->get('/about', function()
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions()
    );

    return $app['twig']->render('about.twig',$data);
})
->bind('about');

/**
 * ADD QUOTE
 */
$app->match('/add-quote', function(Request $request)
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions()
    );

    // Create form and add fields
    $form = $app['form.factory']->createBuilder('form');
    $form->add('id_student','choice',array(
        'choices' => $quotes_model->get_students_for_form()
    ));
    $form->add('content','textarea');

    $form = $form->getForm();
    $form->handleRequest($request);

    $data['form'] = $form->createView();

    if($form->isValid())
    {
        $form_data    = $form->getData();
        $data['add'] = $quotes_model->add_quote($form_data);
    }

    return $app['twig']->render('add-quote.twig',$data);
})
->bind('add-quote');

/**
 * ADD STUDENT
 */
$app->match('/add-student', function(Request $request)
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions()
    );

    // Create form and add fields
    $form = $app['form.factory']->createBuilder('form');
    $form->add('id_promotion','choice',array(
        'choices' => $quotes_model->get_promotions_for_form()
    ));
    $form->add('first_name','text');
    $form->add('last_name','text');

    $form = $form->getForm();
    $form->handleRequest($request);

    $data['form'] = $form->createView();

    if($form->isValid())
    {
        $form_data    = $form->getData();
        $data['add'] = $quotes_model->add_student($form_data);
    }

    return $app['twig']->render('add-student.twig',$data);
})
->bind('add-student');

/**
 * ADD PROMOTION
 */
$app->match('/add-promotion', function(Request $request)
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions()
    );

    // Create form and add fields
    $form = $app['form.factory']->createBuilder('form');
    $form->add('slug','text');
    $form->add('title','text');

    $form = $form->getForm();
    $form->handleRequest($request);

    $data['form'] = $form->createView();

    if($form->isValid())
    {
        $form_data    = $form->getData();
        $data['add'] = $quotes_model->add_promotion($form_data);
    }

    return $app['twig']->render('add-promotion.twig',$data);
})
->bind('add-promotion');

/**
 * PROMOTION
 */
$app->get('/promotion/{slug}', function($slug)
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions(),
        'promotion'  => $quotes_model->get_promotion_by_slug($slug),
        'students'   => $quotes_model->get_student_by_promotion_slug($slug),
    );

    return $app['twig']->render('promotion.twig',$data);
})
->bind('promotion')
->assert('slug','[a-z0-9-]+');

/**
 * STUDENT
 */
$app->get('/student/{id}', function($id)
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions(),
        'student'    => $quotes_model->get_student_by_id($id),
        'quotes'     => $quotes_model->get_quotes_by_student_id($id),
    );

    return $app['twig']->render('student.twig',$data);
})
->bind('student')
->assert('slug','\d+');

/**
 * 404
 */
$app->error(function (\Exception $e, $code)
{
    global $app;
    global $quotes_model;

    if($code !== 404)
        return;

    $data = array(
        'promotions' => $quotes_model->get_all_promotions()
    );

    return $app['twig']->render('404.twig',$data);
});

$app->run();
