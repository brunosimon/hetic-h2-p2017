<?php
    session_start();
    ini_set('display_errors', 0);

	// parameters for PDO
    $server = [
        'host' => 'localhost',
        'user' => 'root',
        'password' => 'root',
        'db_name' => 'exercice-chat-nguyen-kokou'
    ];

    // Smileys
    $smiley = [
        '*a' => 'Ambivalent', 
        '*b' => 'Angry', 
        '*c' => 'Confused', 
        '*d' => 'Content', 
        '*e' => 'Cool', 
        '*f' => 'Crazy', 
        '*g' => 'Cry', 
        '*h' => 'Embarrassed', 
        '*i' => 'Footinmouth', 
        '*j' => 'Frown', 
        '*k' => 'Gasp', 
        '*l' => 'Grin', 
        '*m' => 'Heart', 
        '*n' => 'HeartEyes', 
        '*o' => 'Innocent', 
        '*p' => 'Kiss', 
        '*q' => 'Laughing', 
        '*r' => 'Mini-Frown', 
        '*s' => 'Mini-Smile', 
        '*t' => 'Money-Mouth', 
        '*u' => 'Naughty', 
        '*v' => 'Nerd', 
        '*w' => 'Not-Amused', 
        '*x' => 'Sarcastic', 
        '*y' => 'Sealed', 
        '*z' => 'Sick', 
        '*1' => 'Slant', 
        '*2' => 'Smile', 
        '*3' => 'Thumbs-Down', 
        '*4' => 'Thumbs-Up', 
        '*5' => 'Wink', 
        '*6' => 'Yuck', 
        '*7' => 'Yum'
    ];

    try {
        $pdo = new PDO('mysql:host='.$server['host'].';dbname='.$server['db_name'], $server['user'], $server['password']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->query("SET NAMES 'utf8'");
    }
    catch (Exception $e) {
        echo "Error with the connection MYSQL  : ", $e->getMessage();
        die();
    }
?>