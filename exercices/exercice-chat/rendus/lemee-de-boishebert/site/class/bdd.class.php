<?php
class Base
{
	public function __construct()
	{
		$domaine = "localhost";
		$base = "exercice-chat-lemee-de-boishebert";
		$user = "root";
		$password = "root";

		$this->pdo = new PDO('mysql:host='.$domaine.';dbname='.$base.'', ''.$user.'', ''.$password.'', array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8')); 
	}
}
?>