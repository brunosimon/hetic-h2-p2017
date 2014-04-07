<?php
/*
	This class save users and retrieve via a cookie
*/


class Account
{
	private $_db; // database object

	public function __construct($db)
	{
		$this->setDb($db);
		$this->retrieve();
	}
	
	public function retrieve(){
		/*
			Retrieve a saved user via cookie,
			if exist, return id, login and message
		*/
		
		if(isset($_COOKIE["user_token"])){
			$q = $this->_db->prepare('SELECT id, login, message FROM account WHERE hash_cookie = :user_token');
			$q->bindValue(':user_token', $_COOKIE["user_token"], PDO::PARAM_STR);
			$q->execute();
			
		    $data = $q->fetch(PDO::FETCH_ASSOC);
		    
		    if($data != false){
				$this->id = $data['id'];
				
				$this->login = $data['login'];
				$this->message = $data['message'];
				return true;
		    }
		    else{
			    return false;
		    }
	    }
	    else{
		    return false;
	    }
	}
	
	public function checkToken(){
		/*
			Check validity beetween user_token (hash_cookie in database) and user_id
			Return true if valid, and allow ajax request
		*/
		
		if(isset($_COOKIE["user_token"]) && isset($_COOKIE["user_id"])){
			$q = $this->_db->prepare('SELECT id FROM account WHERE hash_cookie = :user_token');
			$q->bindValue(':user_token', $_COOKIE["user_token"], PDO::PARAM_STR);
			$q->execute();
			
		    $data = $q->fetch(PDO::FETCH_ASSOC);
		    
		    if($data != false){
				if($data['id'] == $_COOKIE["user_id"]){
					return true;
				}
				else{
					return false;
				}
		    }
		    else{
			    return false;
		    }
	    }
	    else{
		    return false;
	    }
	}
	
	public function create($login, $message)
	{
		/*
			Add a new user account to database
		*/
		
		
		$hash_cookie = sha1(uniqid($login));
		
		$q = $this->_db->prepare('INSERT INTO account SET login = :login, message = :message, hash_cookie = :hash_cookie');

	    $q->bindValue(':login', $login, PDO::PARAM_STR);
	    $q->bindValue(':message', $message, PDO::PARAM_STR);
	    $q->bindValue(':hash_cookie',$hash_cookie, PDO::PARAM_STR);
	    
	    $q->execute();
	    
	    // Get the id of the user we just created and set a cookie
	    
	    $q = $this->_db->prepare('SELECT id FROM account WHERE hash_cookie = :hash_cookie');
		$q->bindValue(':hash_cookie', $hash_cookie, PDO::PARAM_STR);
		$q->execute();
		
	    $data = $q->fetch(PDO::FETCH_ASSOC);
	    
	    setcookie("user_id", $data['id'], time()+3600*24*365);
	    setcookie("user_token", $hash_cookie, time()+3600*24*365);
	}
	
	public function update($login, $message)
	{
		/*
			Update login and message when user connect
		*/
		
		$q = $this->_db->prepare('UPDATE account SET login = :login, message = :message WHERE id = :id_user');

	    $q->bindValue(':login', $login, PDO::PARAM_STR);
	    $q->bindValue(':message', $message, PDO::PARAM_STR);
	    $q->bindValue(':id_user',$_COOKIE["user_id"], PDO::PARAM_INT);
	    
	    $q->execute();
	}
	
	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}
}
?>