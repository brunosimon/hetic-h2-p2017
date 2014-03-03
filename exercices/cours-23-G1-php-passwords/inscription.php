<?php 
    require 'config.php';

    if(!empty($_POST))
    {
        $login      = $_POST['login'];
        $password_1 = $_POST['password-1'];
        $password_2 = $_POST['password-2'];

        // Same passwords
        if($password_1 == $password_2)
        {
            $prepare = $pdo->prepare('INSERT INTO users (login,password) VALUES (:login,:password)');
            $prepare->bindValue('login',$login);
            $prepare->bindValue('password',$password_1);
            $exec = $prepare->execute();

            echo '<pre>';
            print_r($exec);
            echo '</pre>';
        }

        // Differents password
        else
        {
            echo 'Passwords doesn\'t match';
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <br /><a href="index.php">Login</a>
    <form action="#" method="POST">
        <div>
            <input type="text" name="login" id="login">
            <label for="login">Login</label>
        </div>
        <div>
            <input type="password" name="password-1" id="password-1">
            <label for="password-1">Password</label>
        </div>
        <div>
            <input type="password" name="password-2" id="password-2">
            <label for="password-2">Password (confirme)</label>
        </div>
        <div>
            <input type="submit" value="Send">
        </div>
    </form>
</body>
</html>