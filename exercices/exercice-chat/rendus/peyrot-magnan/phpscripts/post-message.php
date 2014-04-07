<?php
session_start();
include('functions.php');
$db = db_connect();

if(user_verified()) {
	if(isset($_POST['message']) AND !empty($_POST['message'])) {	

		if(!preg_match("#^[-. ]+$#", $_POST['message'])) {	
			$query = $db->prepare("SELECT * FROM chat_messages WHERE message_user = :user ORDER BY message_time DESC LIMIT 0,1");
			$query->execute(array(
				'user' => $_SESSION['id']
			));
			$count = $query->rowCount();
			$data = $query->fetch();

			if($count != 0)
				similar_text($data['message_text'], $_POST['message'], $percent);

			if($percent < 80) {

				if(time()-5 >= $data['message_time']) {

				} else
					echo 'Eh negro ! On est pas ici pour spammer';	
			} else
				echo 'BOOBA trouve que tu écris souvent la même chose !';	
		} else
			echo 'Eh mais ton message est vide.';	
	} else
		echo 'GO ! Balance une punchline de la mort !';	
} else
	echo 'Vous devez être connecté pour punchliner.';	


$insert = $db->prepare('
	INSERT INTO chat_messages (message_id, message_user, message_time, message_text) 
	VALUES(:id, :user, :time, :text)
');
$insert->execute(array(
	'id' => '',
	'user' => $_SESSION['id'],
	'time' => time(),
	'text' => $_POST['message']
));
echo true;
?>