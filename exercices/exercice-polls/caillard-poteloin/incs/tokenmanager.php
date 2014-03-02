<?php
	if (empty($_COOKIE['token'])) {
		do {
			$token = md5(uniqid(mt_rand(), true));
			$req = $pdo->prepare('SELECT * FROM users WHERE token = :token');
			$req->bindvalue(':token', $token, PDO::PARAM_STR);
			$req->execute();
			$user = $req->fetch();

			$req->closeCursor();
		} while (!empty($user));

		$req = $pdo->prepare('INSERT INTO users(token) VALUES(:token)');
		$req->bindvalue(':token', $token, PDO::PARAM_STR);
		$req->execute();
		
		setcookie('token', $token, time() + (10 * 365 * 24 * 60 * 60), null, null, false, true);
		$_SESSION['token'] = $token;
	}
	else {
		if (!empty($_POST['name'])) {
			$token = $_COOKIE['token'];
			$name = strip_tags(trim($_POST['name']));
			
			if (!empty($name)) {
				$reqAdd = $pdo->prepare('UPDATE users SET name=:name WHERE token=:token');
				$reqAdd->bindvalue(':name', $name, PDO::PARAM_STR);
				$reqAdd->bindvalue(':token', $token, PDO::PARAM_STR);
				$reqAdd->execute();
			}
		}


		$token = $_COOKIE['token'];
		$req = $pdo->prepare('SELECT id, name FROM users WHERE token=:token');
		$req->bindvalue(':token', $token, PDO::PARAM_STR);
		$req->execute();
		if (!($user = $req->fetch())) {
			$reqAdd = $pdo->prepare('INSERT INTO users(token) VALUES(:token)');
			$reqAdd->bindvalue(':token', $token, PDO::PARAM_STR);
			$reqAdd->execute();
		}
		else {
			$_SESSION['name'] = $user['name'];	
		}
		
		$_SESSION['token'] = $token;

	}