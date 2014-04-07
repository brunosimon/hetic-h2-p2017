<?php
    require('../data/config.php');

    $messages = $db->prepare("SELECT * FROM messages WHERE room_id = :id ORDER BY id DESC");
    $messages->bindvalue(':id', $_POST['id'], PDO::PARAM_INT);
    $messages->execute();
    
    while($message = $messages->fetch()){

        $good_message = $message['text'];

        $smiley    = $db->query("SELECT * FROM smiley");
        $bad_words = $db->query("SELECT * FROM bad_words");

        // Verification des Smileys
        while($value = $smiley->fetch()){
            $good_message = str_replace($value['short'], '<img src="./src/images/smileys/'.$value['smiley'].'">', $good_message);
        }
        // Verification des gros mots
        while($value_2 = $bad_words->fetch()){
            $good_message = str_replace($value_2['word'], '-----', $good_message);
        }

        echo '
        <div>
            <span class="author">'.$message['author'].' :</span>
            <span class="text">'.$good_message.'</span>
            <span class="date"><span class="glyphicon glyphicon-thumbs-up like"></span> - ('.$message['date'].')</span>
        </div>';

    }
?>