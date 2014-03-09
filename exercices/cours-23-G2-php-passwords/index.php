<?php 
    require 'config.php';
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