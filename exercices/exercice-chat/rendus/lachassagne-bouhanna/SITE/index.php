<?php

	require('partials/include/config.php');
	session_start();

	if(isset($_SESSION['id']))
	{
		$query = $pdo->prepare("SELECT * FROM users WHERE id = :id");
		$query->bindvalue(":id", $_SESSION['id'],PDO::PARAM_STR);
		$query->execute();
		
		$info_user = $query->fetch();
	
		$current_username = $info_user['login'];
	} else {
	}


	$case = explode('/', $_SERVER['REQUEST_URI']); 

	$is404 = false;
	
	switch ($case[1]) {
		case "":
			$page = 'home.php';
		break;
		case "register":
			if(isset($case[2])){$is404 = true;}
				$page = 'register.php';
				break;
		case "login":
			if(isset($case[2])){$is404 = true;}
				$page = 'login.php';
				break;
		case "logout":
			if(isset($_SESSION['id'])) {
				if(isset($case[2])){$is404 = true;}
					$page = 'logout.php';
			}
			else
					$page = 'home.php';
			break;
		case "debates":
			if(isset($_SESSION['id'])) {
				if(isset($case[2])){$is404 = true;}
					$page = 'debates.php';
			}
			else
					$page = 'home.php';
				break;
		case "new-debate":
			if(isset($case[2])){$is404 = true;}
				$page = 'new-debate.php';
				break;
		case "account":
			if(isset($case[2])){$is404 = true;}
				$page = 'my-account.php';
				break;
		default:
			$is404 = true;
			break;
	}
	
	if($is404){
		header("HTTP/1.0 404 Not Found");
		echo 'not found';	
	}
	else{
		require_once('partials/include/header.php');
		require_once('partials/template/' . $page);
		require_once('partials/include/footer.php');
	}
?>