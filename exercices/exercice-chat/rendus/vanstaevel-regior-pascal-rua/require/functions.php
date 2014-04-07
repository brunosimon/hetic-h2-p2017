<?php 

function sanetize($data) // cleans user inputs
  {
    $data['login']      = strip_tags(trim($data['login']));
    $data['password']   = strip_tags(trim($data['password']));
    return $data;
  }

function sanetize_register($data)// cleans user inputs
  {
    $data['login']              = strip_tags(trim($data['login']));
    $data['password']           = strip_tags(trim($data['password']));
    $data['password_confirm']   = strip_tags(trim($data['password_confirm']));
    return $data;
  }

function check($data)
  {
    global $pdo;
    $errors = array(); 
    $_SESSION['login'] = $_POST['login'];
    $password = $_POST['password'];

    //login
    if (empty($data['login'])) // empty login
      $errors['login'] = "You have to choose a login";
      
    //password
    if (empty($data['password'])) // password empty
      $errors['password'] = "You have to choose a password";

    // recuperation of all login in DB
    $prepare = $pdo->prepare('SELECT * FROM password WHERE login = :login');
    $prepare->bindValue(':login', $_SESSION['login']); 
    $prepare->execute();
    $user = $prepare->fetch();
 
    //if user foud
    if ($user)
    {
      if(hash('sha256',$password.SALT) != $user['password']) // no correspondance between passwords
        $errors['password'] = "Incorrect password";
     }

    // user not found
    else{
      $errors['login'] = "User not found";
    }

    return $errors;
  }

function check_register($data)
  {
    global $pdo;
    $errors = array();
    $login = $_POST['login']; 
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    // recuperation of all login in DB
    $prepare = $pdo->prepare('SELECT * FROM password WHERE login = :login');
    $prepare->bindValue(':login', $login); 
    $prepare->execute();
    $user = $prepare->fetch();

    //user already used
    if($user) 
      $errors['login'] = "Login already used";

    //login
    if (empty($data['login'])) // empty login
      $errors['login'] = "You have to choose a login";
      
    //password
    if (empty($data['password'])) // empty password
      $errors['password'] = "You have to choose a password";

    //password_confirm
    if (empty($data['password_confirm'])) // empty password confirm
      $errors['password'] = "You have to confirm your password";

    // password and password_confirm different
    if ($password != $password_confirm)
      $errors['password'] = 'password not ok';

    return $errors;
  }
 ?>