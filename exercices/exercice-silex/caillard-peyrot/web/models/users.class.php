<?php
class Users_Model {
  function __construct($pdo) {
    $this->pdo = $pdo;
  }

  function get($page = 1, $limit = 5) {
    $start = ($page-1)*$limit;
    $prepare = $this->pdo->prepare('
      SELECT * FROM users LIMIT :start, :limit
    ');
    $prepare->bindValue('start', $start, PDO::PARAM_INT);
    $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }

  function getById($id = 1) {
    $prepare = $this->pdo->prepare('
      SELECT * FROM users WHERE id = :id
    ');
    $prepare->bindValue('id', $id, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }

  function getByUsername($username) {
    $prepare = $this->pdo->prepare('
      SELECT * FROM users WHERE username = :username
    ');
    $prepare->bindValue('username', $username, PDO::PARAM_INT);
    $prepare->execute();
    $result = $prepare->fetchAll();

    return $result;
  }

  function create($data) {
    global $salt;
    $username = htmlentities($data['username']);
    $mail = $data['mail'];
    $password = $data['password'];
    $confirm = $data['confirm'];
    $errors = [];

    if (strlen($username) < 3)
      $errors[] = "Username's too short";
    if (strlen($password) < 5)
      $errors[] = "Password's too short";
    $regex = '/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/';
    if (!preg_match($regex, $mail))
      $errors[] = "Your mail address is not valid.";

    //Check if username exists
    $prepare = $this->pdo->prepare('
      SELECT id FROM users WHERE LOWER(username) = LOWER(:username)
    ');
    $prepare->bindValue('username', $username);
    $prepare->execute();
    $result = $prepare->fetchAll();
    if (!empty($result))
      $errors[] = "This username already exists";

    //Check if mail exists
    $prepare = $this->pdo->prepare('
      SELECT id FROM users WHERE LOWER(mail) = LOWER(:mail)
    ');
    $prepare->bindValue('mail', $mail);
    $prepare->execute();
    $result = $prepare->fetchAll();
    if (!empty($result))
      $errors[] = "This mail already exists";

    //Check if passwords match
    if ($password !== $confirm)
      $errors[] = "Passwords doesn't match";

    // Check if everything is al'ight
    if (!empty($errors))
      return $errors;

    // No error, create user
    $password = hash('sha512', $password.$salt);

    $prepare = $this->pdo->prepare('
      INSERT INTO users SET
        username = :username,
        password = :password,
        mail = :mail
    ');
    $prepare->bindValue('username', $username);
    $prepare->bindValue('password', $password);
    $prepare->bindValue('mail', $mail);
    $result = $prepare->execute();

    return $result;
  }

  function login($data) {
    global $salt;
    $username = $data['username'];
    $password = hash('sha512', $data['password'].$salt);

    $prepare = $this->pdo->prepare('
      SELECT password FROM users WHERE username = :username
    ');

    $prepare->bindValue('username', $username);
    $prepare->execute();
    $result = $prepare->fetchAll();

    if (!empty($result) && $password == $result[0]['password']) {
      return true;
    }
    return false;
  }
}