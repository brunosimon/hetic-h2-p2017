<?php 

    //E_ALL
    //E_WARNING
    //E_PARSE
    //E_NOTICE
    error_reporting(E_ALL);
    ini_set("display_errors",1);

    $foo = ['test1','test2','test3'];


    // echo $foo[3];
    // include 'fichier_qui_nexiste_pas.php';
    // require 'fichier_qui_nexiste_pas.php';

    function foo(){}

    try
    {
        include 'fichier_qui_nexiste_pas.php';
    }
    catch(Exception $e)
    {
        die('Erreur caught');
    }

