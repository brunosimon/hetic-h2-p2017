<?php 
session_start();

if(!empty($_POST))
{
   // Message storage in messages table
   require_once 'require/config.php';

   $insert = $pdo->prepare("INSERT INTO messages (login, message, `date`) VALUES (:login, :message, NOW())");
   $insert->bindvalue(':login', $_SESSION["login"], PDO::PARAM_STR);
   $insert->bindvalue(':message', $_POST['message'], PDO::PARAM_STR);
   $insert->execute();
   return true;
   
   die('message : '.$_POST['message']);
}