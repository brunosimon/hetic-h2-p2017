<?php

/**
 * Admins Model
 */
class Admins_Model
{
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    function is_admin($admin)
    {
    	$prepare = $this->pdo->prepare('
            SELECT
                username,
                password
            FROM
                admins
            WHERE 
            	username = :username
        ');
        $prepare->bindValue('username', $admin['username']);
        $prepare->execute();
        $result = $prepare->fetch();

        if(empty($result))
        	return 'User not found.';
        else if($result['password'] !== hash('sha256', $admin['password']))
        	return 'Invalid password.';

        return true;
    }

}