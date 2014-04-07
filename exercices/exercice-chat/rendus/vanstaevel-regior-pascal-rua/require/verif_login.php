<?php
  require_once ('require/functions.php');
  session_start();
  $login_save = "";
  $password_save = "";
  $errors = array(); // errors table
  $data = array(
        'login'=> '',
        'password'=> ''
  );

  // Verification of the existence of user and password
	if(!empty($_POST)&& isset($_POST["login"]) && !empty($_POST["login"])){
      $data = sanetize($_POST);
      $errors = check($data);
      if(empty($errors)) // login and password ok
      {
        header("Location:chat.php");
      }

      else{
        $login_save = $_POST['login'];
        $password_save = $_POST['password'];
      }
  }	 
?>

