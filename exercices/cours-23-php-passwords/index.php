<?php 

    /**
     * LOGIN PAGE
     */
    
    require_once 'config.php';

    // Datas sent
    if(!empty($_POST))
    {
        // Datas ok
        if(!empty($_POST['email']) && !empty($_POST['password']))
        {
            // Get email and password
            $email    = $_POST['email'];
            $password = $_POST['password'];

            // Try to get user from database
            $prepare = $pdo->prepare('SELECT * FROM users WHERE email = :email LIMIT 1');
            $prepare->bindValue(':email',$email);
            $query = $prepare->execute();
            $user  = $prepare->fetch();

            // User found
            if(!empty($user))
            {
                // Ecrypted + salted password match
                if($user['password'] == hash('sha256',$password.STATIC_SALT))
                {
                    echo 'Good password, you shall pass';
                }

                // Password doesn't match
                else
                {
                    echo 'Wrong password, you shall not pass';
                }
            }

            // User not found
            else
            {
                echo 'No user found with this email';
            }
        }

        // Datas not ok
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
    <br /><a href="inscription.php">Inscription</a>
    <h1>Login</h1>
    <form action="#" method="POST">
        <div>
            <input type="text" name="email" id="email">
            <label for="email">Email</label>
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