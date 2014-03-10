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

        // User found
        if($user)
        {
            // Password match
            if(hash('sha256',$password.SALT) == $user['password'])
            {
                echo 'You shall pass';
            }
            
            // Password doesn't match
            else
            {
                echo 'You shall not pass';
            }
        }

        // User not found
        else
        {
            echo 'user not found';
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
            <input type="submit" value="Envoyer">
        </div>
    </form>
</body>
</html>