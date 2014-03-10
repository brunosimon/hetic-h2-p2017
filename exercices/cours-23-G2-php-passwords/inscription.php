<?php 
    require 'config.php';

    if(!empty($_POST))
    {
        $login            = $_POST['login'];
        $password         = $_POST['password'];
        $password_confirm = $_POST['password-confirm'];

        // Same passwords
        if($password == $password_confirm)
        {
            $prepare = $pdo->prepare('INSERT INTO users (login,password) VALUES (:login,:password)');
            $prepare->bindValue(':login',$login);
            $prepare->bindValue(':password',hash('sha256',$password.SALT));
            $exec = $prepare->execute();

            if($exec)
                echo 'User added';
        }

        // Different passwords
        else
        {
            echo 'passwords not ok';
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
            <input type="password" name="password" id="password">
            <label for="password">Password</label>
        </div>
        <div>
            <input type="password" name="password-confirm" id="password-confirm">
            <label for="password-confirm">Password (confirm)</label>
        </div>
        <div>
            <input type="submit" value="Envoyer">
        </div>
    </form>
</body>
</html>