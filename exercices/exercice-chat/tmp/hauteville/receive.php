<?php 

session_start();
require_once 'config.php';
$messages = array();
$result = $pdo->query('SELECT * FROM messages ORDER BY id DESC LIMIT 15');
$i = 0;

while($mes = $result->fetch()){

    $result2 = $pdo->query("SELECT * FROM users WHERE id = '".$mes['user_id']."' LIMIT 1");
    $user = $result2->fetch();

     $smiley = array(
        ':)' => "<img src='images/content.gif'>",
        '<3' => "<img src='images/coeur.gif'>",
        ':(' => "<img src='images/pascontent.gif'>",
        ":'(" => "<img src='images/triste.gif'>",
        ":$" => "<img src='images/timide.gif'>"

    );

    foreach ($smiley as $key => $value) {
        $mes['message'] = str_replace($key, $value, $mes['message']);
    }

    $messages[$i] = array(
                'pseudo'  => $user['login'],
                'date'    => date('H:m:s',strtotime($mes['date'])),
                'message' => $mes['message'],
                'sexe' => $user['sexe'],
                'background_color' => $user['color']
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