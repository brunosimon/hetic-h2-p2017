<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;
require 'config.php';

// Home
$app->get('/',function()
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Home',
        'snippets' => $snippets_model->get(),
    );

    return $app['twig']->render('home.twig',$data);
})
->bind('home');

// Page
$app->get('/page/{page}', function($page)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Page',
        'snippets' => $snippets_model->get_by_page($page),
    );

    return $app['twig']->render('page.twig',$data);
})
->bind('page')
->assert('page','\d+');

// Category
$app->get('/category/{category}',function($category)
{
    global $app;
    global $snippets_model;

    $data = array(
        'title'    => 'Category',
        'snippets' => $snippets_model->get_by_category_slug($category),
    );

    return $app['twig']->render('category.twig',$data);
})
->bind('category')
->assert('category','[a-z0-9-]+');

// Contact
$app->match('/contact',function(Request $request)
{
    global $app;

    // Create form and add fields
    $form = $app['form.factory']->createBuilder('form');
    $form->add('name','text',array(
        'constraints' => new Assert\Length(array('min' => 5))
    ));
    $form->add('subject','text',array(
        'constraints' => new Assert\Length(array('min' => 5))
    ));
    $form->add('message','textarea',array(
        'constraints' => new Assert\Length(array('min' => 5))
    ));

    $form = $form->getForm();

    $form->handleRequest($request);

    if($form->isValid())
    {
        $data = $form->getData();

    }

    $data = array(
        'title' => 'Contact',
        'form'  => $form->createView()
    );

    return $app['twig']->render('contact.twig',$data);
});

// Suggest
$app->match('/suggest',function(Request $request)
{
    global $app;

    $choices = array(
        1 => 'HTML',
        2 => 'PHP',
        3 => 'CSS',
        4 => 'JS',
    );

    $form = $app['form.factory']->createBuilder('form')
                                ->add('title','text',array(
                                    'constraints' => new Assert\Length(array('min' => 5))
                                ))
                                ->add('category','choice',array(
                                    'choices'     => $choices,
                                    'constraints' => new Assert\Choice(array_keys($choices))
                                ))
                                ->add('content','textarea')
                                ->add('send','submit')
                                ->getForm();

    $form->handleRequest($request);

    if($form->isValid())
    {
        $data = $form->getData();
    }

    $data = array(
        'title' => 'Suggest',
        'form'  => $form->createView()
    );

    return $app['twig']->render('suggest.twig',$data);
});


$app->run();








