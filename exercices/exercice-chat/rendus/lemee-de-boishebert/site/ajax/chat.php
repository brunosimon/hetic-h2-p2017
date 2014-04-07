<?php
	/*
		For security purpose, all ajax request check correspondance between user_token (store in a cookie) and user_id (also store in a cookie).
	*/

	include('../config.php');
	$session = new Session($base->pdo);
	$account = new Account($base->pdo);
	$chat = new Chat($base->pdo);
	
	$session->activity($_COOKIE['user_id']);
	
	// Set a new session when user connect
	if($_POST['action'] == 'send' && isset($_POST['message'])){
		
		if($account->checkToken()){
			$chat->sendmessage($_COOKIE['user_id'], $session->peer_id($_COOKIE['user_id']), $_POST['message']);
		}
	}
	
	if($_POST['action'] == 'check' && isset($_POST['id_last_message'])){
		if($account->checkToken()){
			echo $chat->checkmessage($_POST['id_last_message']);
		}
	}
	
	
	// Check if video mode is actived for the peer, return peer id if ok
	if($_POST['action'] == 'video_mode'){
		if($account->checkToken()){
			echo $chat->videomode($_COOKIE['user_id']);
		}
	}
	
	// Close current chat and find a new one
	if($_POST['action'] == 'next'){
		if($account->checkToken()){
			$session->next();
		}
	}
	
	// Get the infos of the peer such as his name, description message and location
	if($_POST['action'] == 'peerinfos'){
		if($account->checkToken()){
			echo $session->peerinfos($_COOKIE['user_id']);
		}
	}

?>