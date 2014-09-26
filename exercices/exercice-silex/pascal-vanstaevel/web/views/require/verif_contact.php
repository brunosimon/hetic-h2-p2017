<?php 
	if(!empty($_POST){
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
 ?>