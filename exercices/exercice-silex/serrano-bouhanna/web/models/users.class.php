<?php
class Users_Model {

    function __construct($pdo) {
        $this->pdo = $pdo;
    }

    function get($page = 1, $limit = 5) {
        $start = ($page-1)*$limit;
        $prepare = $this->pdo->prepare('
          SELECT
            *
          FROM
            users
          LIMIT
            :start, :limit
        ');

        $prepare->bindValue('start', $start, PDO::PARAM_INT);
        $prepare->bindValue('limit', $limit, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll();

        return $result;
    }

    function getById($id = 1) {
        $prepare = $this->pdo->prepare('
          SELECT
            *
          FROM
            users
          WHERE
            id = :id
        ');

        $prepare->bindValue('id', $id, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll();

        return $result;
    }

    function getByName($username) {
        $prepare = $this->pdo->prepare('
          SELECT
            *
          FROM
            users
          WHERE
            username = :username
        ');

        $prepare->bindValue('username', $username, PDO::PARAM_INT);
        $prepare->execute();
        $result = $prepare->fetchAll();
        return $result;
    }

    function create($data) {
        global $salt;
        $username = $data['username'];
        $mail = $data['mail'];
        $password = hash('sha512', $data['password'].$salt);

        //Check if username exists
        $prepare = $this->pdo->prepare('
          SELECT
            id
          FROM
            users
          WHERE
            username = :username
        ');

        $prepare->bindValue('username', $username);
        $prepare->execute();
        $result = $prepare->fetchAll();

        if (!empty($result)) {
          $error = "This username already exists";
          return $error;
        }

        //Check if mail exists
        $prepare = $this->pdo->prepare('
          SELECT
            id
          FROM
            users
          WHERE
            mail = :mail
        ');

        $prepare->bindValue('mail', $mail);
        $prepare->execute();
        $result = $prepare->fetchAll();
        if (!empty($result)) {
          $error = "This mails already exists";
          return $error;
        }

        // No error, create user
        $prepare = $this->pdo->prepare('
          INSERT INTO
            users
          SET
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
          SELECT
            password
          FROM
            users
          WHERE
            username = :username
        ');

        $prepare->bindValue('username', $username);
        $prepare->execute();
        $result = $prepare->fetchAll();

        if ($password == $result[0]['password']) {
          return true;
        }

        return false;
    }
}