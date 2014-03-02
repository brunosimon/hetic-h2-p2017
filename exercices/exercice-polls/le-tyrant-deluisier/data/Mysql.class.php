<?php
class Database {

	private static $singleton = null;
	
	public static function openDB($dbname, $user, $password, $host, $port, $type){

		if( is_null(self::$singleton)){
			self::$singleton = new PDO("$type:host=$host;port=$port;dbname=$dbname", $user, $password); // Création de la connexion
			self::$singleton->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$singleton->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
			self::$singleton->setAttribute(PDO::MYSQL_ATTR_INIT_COMMAND, "SET NAMES 'utf8'");
			self::$singleton->query("SET NAMES 'utf8'");
		}
	}

	public static function DB(){
		return self::$singleton;
	}
}
?>