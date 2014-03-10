<?php 

    require 'config.php';

    if(!empty($_POST))
    {
        $login    = $_POST['login'];
        $password = $_POST['password'];

        $prepare = $pdo->prepare('SELECT * FROM users WHERE login = :login');
        $prepare->bindValue(':login',$login);
        $prepare->execute();
        $user = $prepare->fetch();

        // No user found
        if(empty($user))
        {
            echo 'User not found';
        }

        // User found
        else
        {
            // Good password
            if($user['password'] == hash('sha256',$password.SALT))
            {
                echo 'You shall pass';
            }

            // Wrong password
            else
            {
                echo 'You shall not pass';
            }
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
    <br /><a href="inscription.php">Inscription</a>
    <form action="#" method="POST">
        <div>
            <input type="text" name="login" id="login">
            <label for="login">Login</label>
        </div>
        <div>
            <input type="password" name="password" id="password">
            <label for="password">Password</label>
        </div>
        <div>
            <input type="submit" value="Send">
        </div>
    </form>
</body>
</html>