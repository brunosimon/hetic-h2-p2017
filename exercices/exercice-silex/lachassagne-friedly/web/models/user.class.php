<?php

/**
* SNIPPETS
*/
class User_Model
{
	function __construct($pdo){
		$this->pdo = $pdo;
	}

	function new_user($name,$pass){
		$prepare = $this->pdo->prepare('INSERT INTO users (name, password) VALUES (:name,:password)');
		$prepare->bindValue(':name',$name,PDO::PARAM_STR);
		$prepare->bindValue(':password',hash('sha256', $pass.SALT),PDO::PARAM_STR);
		$prepare->execute();
	}

	function connect_user($name,$pass, $app){
		$prepare = $this->pdo->prepare('SELECT * FROM users WHERE name = :name');
		$prepare->bindValue(':name',$name,PDO::PARAM_STR);
		$prepare->execute();
		$user = $prepare->fetch();

		$username = $user['name'];
		$password = $user['password'];

		if(hash('sha256', $pass.SALT) == $password){
			$app['session']->set('Connected', true);
			$app['session']->set('Username', $username);
			$app['session']->set('id', $user['id']);
		} else {
			echo "wrong password";
		}
	}

	function get_own_snippets($id){
		$prepare = $this->pdo->prepare('SELECT * FROM snippets WHERE id_sender = :id');
		$prepare->bindValue(':id',$id,PDO::PARAM_INT);
		$prepare->execute();

		return $prepare->fetchAll();
	}
}
