<?php
	/*
		For security purpose, all ajax request check correspondance between user_token (store in a cookie) and user_id (also store in a cookie).
	*/

	include('../config.php');
	$session = new Session($base->pdo);
	$account = new Account($base->pdo);
	
	// Set a new session when user connect
	if($_POST['action'] == 'new' && isset($_POST['lat']) && isset($_POST['long']) && isset($_POST['video_auto'])){
		if($account->checkToken()){
			// Account is created everytime a new user connect (determinated via cookie)
			// The account saves his name and description message
			$account->update($_POST['login'], $_POST['message']);
			
			// Then, a new session associated with the user is set
			$session->set($_COOKIE['user_id'], $_POST['lat'], $_POST['long'], 2, $_POST['video_auto']);
			$session->add();
		}
	}
	
	if($_POST['action'] == 'sync'){
		if($account->checkToken()){
			$session->activity($_COOKIE['user_id']);
		}
	}
	
	if($_POST['action'] == 'findpeer'){
		if($account->checkToken()){
			$session->find_peer($_COOKIE['user_id']);
		}
	}

?>