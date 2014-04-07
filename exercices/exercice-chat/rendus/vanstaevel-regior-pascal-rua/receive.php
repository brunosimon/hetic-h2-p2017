<?php 

	require_once 'require/config.php';

	$messages = array();

	$smileys = array(	"<img src='src/img/PNG/Mini-Smile.png'/>",
	 					"<img src='src/img/PNG/Grin.png'/>",
	 					"<img src='src/img/PNG/Slant.png'/>",
	 					"<img src='src/img/PNG/Yuck.png'/>",
	 					"<img src='src/img/PNG/Embarrassed.png'/>",
	 					"<img src='src/img/PNG/Gasp.png'/>",
	 					"<img src='src/img/PNG/Thumbs-Up.png'/>");
	$textes = array(	":)",
	 					":D",
	 					":/",
	 					":p",
	 					":(",
	 					":o",
	 					"(y)");

	$result = $pdo->query('SELECT * FROM messages ORDER BY id DESC LIMIT 30'); // recovery of messages stored in database and display of 30 last
	$i = 0;
	while ($user = $result->fetch()){
		$message_edit = str_replace($textes, $smileys, $user['message']);
		$messages[$i] = array(
	        'pseudo' => $user['login'],
	        'date' => $user['date'],
	        'message' => $message_edit
	    );
	    $i++;
	}

	 
	// variable returned in JSON
	$return = array(
	    'messages' => $messages
	);


	die(json_encode($return));
