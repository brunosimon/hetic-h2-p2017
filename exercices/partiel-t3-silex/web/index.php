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
        'quotes'     => $quotes_model->get_all_quotes()
    );

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

/**
 * ADD QUOTE
 */
$app->match('/add-quote', function(Request $request)
{
    global $app;
    global $quotes_model;

    $data = array();

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
 * PROMOTION
 */
$app->get('/promotion/{slug}', function($slug)
{
    global $app;
    global $quotes_model;

    $data = array(
        'promotion'  => $quotes_model->get_promotion_by_slug($slug),
        'students'   => $quotes_model->get_student_by_promotion_slug($slug),
    );

    return $app['twig']->render('promotion.twig',$data);
})
->bind('promotion');

/**
 * STUDENT
 */
$app->get('/student/{id}', function($id)
{
    global $app;
    global $quotes_model;

    $data = array(
        'student'    => $quotes_model->get_student_by_id($id),
        'quotes'     => $quotes_model->get_quotes_by_student_id($id),
    );

    return $app['twig']->render('student.twig',$data);
})
->bind('student');

/**
 * 404
 */
$app->error(function (\Exception $e, $code)
{
    global $app;

    if($code !== 404)
        return;

    return $app['twig']->render('404.twig');
});

$app->run();
