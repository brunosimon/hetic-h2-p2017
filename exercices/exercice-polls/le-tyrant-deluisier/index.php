<?php
	// Display Error
	ini_set('display_errors', 1);
	session_start();

	// Require
	require('data/Affichage.class.php');
	require('data/Questionnaire.class.php');
	require('data/Survey.class.php');
	require('data/User.class.php');
	require_once('data/Mysql.class.php');

	// Connect to Database
	try{
		Database::openDB('questionnaire', 'root', 'root', 'localhost', 3306, 'mysql');
	}
	catch (PDOException $e){
		die('Erreur : '.$e->getMessage());
	}

	$affichage = new Affichage();
?>