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
    $_SESSION['login'] = $_POST['login'];
    $password = $_POST['password'];
    $data = sanetize_register($_POST);
    $errors = check_register($data);
    if(empty($errors)) // login, password and password_confirm ok
    {
      $prepare = $pdo->prepare('INSERT INTO password (login, password) VALUES (:login, :password)');// request preparation
      $prepare -> bindValue(':login', $_SESSION["login"]);
      $prepare -> bindValue(':password', hash('sha256',$password.SALT));
      $exec = $prepare->execute(); // request execution
      
       if($exec) // if exec positive
        header("Location:chat.php");
    }
    else{
       $login_save = $_POST['login'];
       $password_save = $_POST['password'];
    }
  }  

