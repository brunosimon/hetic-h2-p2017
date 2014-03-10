<?php 


// Message statiques
// Il faudra par la suite que les messages viennent de la base de données
$messages = array(
    array(
        'pseudo'  => 'Mr X',
        'date'    => date('Y-m-d h:i:s'),
        'message' => 'Salut'
    ),
    array(
        'pseudo'  => 'Mrs X',
        'date'    => date('Y-m-d h:i:s'),
        'message' => 'Hey'
    )
);

// Variable qui sera renvoyée encodée en JSON (objet)
$return = array(
    'messages' => $messages
);


// La fonction json_encode va convertir notre tableau en objet qui sera directement interprété comme tel par notre JS
die(json_encode($return));