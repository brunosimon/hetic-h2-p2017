<?php

/**
* Users Model
*/
class Users_Model 
{
    
	public function __construct($app) {
		$this->app = $app;
	}
    
    /**
        Hash a password
        @param $password password to hash
        @return Password hashed and salted
    */
    public function hash_password($password){
        $salt    = '8Qqudè!è§S76D';
        return hash('sha256', $password.$salt);
    }
	
    /**
        Add a user to the DB
        @param $email email of the user
        @param $pseudo pseudo of the user
        @param $passwordpassword of the user
        @return Different message if it works or not. We should not have put text inside, only variables.
    */
    public function add($email, $pseudo, $password){
        
        $sql = '
	        SELECT 
	            pseudo, email                
	        FROM 
	            users
            WHERE
                pseudo = ? OR email = ?
            ';
        $conditions = array($pseudo, $email);
        $result = $this->app['db']->fetchAssoc($sql, $conditions);
        
        if (!empty($result)) {
            if ($result['pseudo'] == $pseudo){
                return array('error' => 'This pseudo is already taken');
            }else {
                return array('error' => 'This email is already taken');
            }
        
        
        }else{        
            $parameters = array(
                'email' => $email,
                'pseudo' => $pseudo,
                'password' => $this->hash_password($password),
            );
            $this->app['db']->insert('users', $parameters);
             return array('success' => 'You have successfully been registered');
        }
       
    }
    
    /**
        Try to log in
        @param $pseudo pseudo of the user
        @param $passwordpassword of the user
        @return Different message if it works or not. We should not have put text inside, only variables.
    */
    public function connect($pseudo, $password){
        $sql = '
	        SELECT 
	            *               
	        FROM 
	            users
            WHERE
                pseudo = ?
            ';
        $conditions = array($pseudo);
        $result = $this->app['db']->fetchAssoc($sql, $conditions);
        
        if (!empty($result)){
            if ($result['password'] == $this->hash_password($password)){
                $this->app['session']->set('user', array('username' => $pseudo));
                
                return array ('success' => 'You have successfully been logged in');
            }else {
                return array('error' => 'You have the wrong password');
            }
        } else {
            return array('error' => 'No user found');
        }
    }
    
    /**
        Check if there is someone connected
        @return true if yes, false if not
    */
    public function check_connected(){
        if (null === $this->app['session']->get('user')) {
            return false;
        }else{
            return true;
        }
    }
    
    /**
        Erase session
    */
    public function log_out(){
        $this->app['session']->clear(); 
    }
}
