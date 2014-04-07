<?php 

session_start();
require_once 'config.php';
$messages = array();
$result = $pdo->query('SELECT * FROM messages ORDER BY id DESC LIMIT 10');
$i = 0;

while($mes = $result->fetch()){

    $result2 = $pdo->query("SELECT * FROM users WHERE id = '".$mes['user_id']."' LIMIT 1");
    $user = $result2->fetch();

    $messages[$i] = array(
                'pseudo'  => $user['login'],
                'date'    => date('H:m:s',strtotime($mes['date'])),
                'message' => $mes['message']
            );
    $i++;
}

// Message statiques
// Il faudra par la suite que les messages viennent de la base de données
    

// Variable qui sera renvoyée encodée en JSON (objet)
$return = array(
    'messages' => array_reverse($messages)
);


// La fonction json_encode va convertir notre tableau en objet qui sera directement interprété comme tel par notre JS
die(json_encode($return));