<?php 
    
    // Affichage des erreurs
    error_reporting(E_ALL);
    ini_set('display_errors',1);

    session_start();


    $login = !empty($_SESSION['login']) ? $_SESSION['login'] : '';


    // Login sent
    if(!empty($_POST['login']))
    {
        $login = $_POST['login'];
        $_SESSION['login'] = $login;
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 22 - G2 - Sessions</title>
</head>
<body>
    <p>
        <?php 
            if(!empty($login))
                echo 'Bonjour '.$login;
            else
                echo 'Indiquez votre login';
        ?>
    </p>
    <form action="#" method="post">
        <input type="text" name="login" placeholder="login" />
        <input type="submit" />
    </form>
</body>
</html>