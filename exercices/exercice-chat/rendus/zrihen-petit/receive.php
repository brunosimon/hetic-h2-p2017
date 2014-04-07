<?php
    session_start();
    require'config.php';
    
// Message statiques

    $login=$_SESSION['login'];

// Message statiques

// Il faudra par la suite que les messages viennent de la base de données


    $affiche_mess = $pdo->prepare("SELECT * FROM chat ORDER BY id DESC LIMIT 1");
    $affiche_mess ->execute();
    $return = $affiche_mess->fetchAll();



// Variable qui sera renvoyée encodée en JSON (objet)
// $return = array(
//     'messages' => $messages
// );


// La fonction json_encode va convertir notre tableau en objet qui sera directement interprété comme tel par notre JS
die(json_encode($return));