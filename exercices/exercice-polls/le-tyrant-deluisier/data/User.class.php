<?php

class User {

	// Insert User
	public function insert ($post){
		extract($post);
		$finalpass = base64_encode(sha1($password, true));

		$insert = DATABASE::DB()->prepare("INSERT INTO users (name, password, mail) VALUES (:name, :password, :mail)");
		$insert->bindvalue(':name', $username, PDO::PARAM_STR);
		$insert->bindvalue(':password', $finalpass, PDO::PARAM_STR);
		$insert->bindvalue(':mail', $mail, PDO::PARAM_STR);
		$insert->execute();
	}

	// Connect User
	public function connect ($post){
		extract($post);
		$finalpass = base64_encode(sha1($password, true));

		$select = DATABASE::DB()->prepare("SELECT * FROM users WHERE name = :name AND password = :password");
		$select->bindvalue(':name', $username, PDO::PARAM_STR);
		$select->bindvalue(':password', $finalpass, PDO::PARAM_STR);
		$select->execute();
		$correspondance = $select->fetch();

		if ($correspondance){
			$_SESSION['login'] = 'ON';
			$_SESSION['id'] = $correspondance['id'];
			$_SESSION['name'] = $correspondance['name'];
			$_SESSION['nb_survey'] = $correspondance['nb_survey'];
		}
	}

	// Disconect User
	public function disconnect (){
		session_destroy();
	}

}

?>