<?php 

    /**
     * INSCRIPTION PAGE
     */
    
    require_once 'config.php';

    if(!empty($_POST))
    {
        if(!empty($_POST['email']) && !empty($_POST['password-1']) && !empty($_POST['password-2']))
        {
            if($_POST['password-1'] != $_POST['password-2'])
            {
                echo 'different password';
            }
            else
            {
                $email    = $_POST['email'];
                $password = hash('sha256',$_POST['password-1'].STATIC_SALT);
                $prepare  = $pdo->prepare('INSERT INTO users (email,password) VALUES (:email,:password)');

                $prepare->bindValue(':email',$email);
                $prepare->bindValue(':password',$password);
                
                $exec = $prepare->execute();
                
                echo 'user saved';
            }
        }
        else
        {
            echo 'errors';
        }
    }
?>
<html>
<head>
    <title>Cours 23 - PHP Passwords</title>
</head>
<body>
    <br />
    <a href="index.php">Login</a>
    <h1>Inscription</h1>
    <form action="#" method="POST">
        <div>
            <input type="text" name="email" id="email">
            <label for="email">Email</label>
        </div>
        <div>
            <input type="password" name="password-1" id="password-1">
            <label for="password-1">Password</label>
        </div>
        <div>
            <input type="password" name="password-2" id="password-2">
            <label for="password-2">Password (confirmation)</label>
        </div>
        <div>
            <input type="submit" value="Envoyer">
        </div>
    </form>
</body>
</html>