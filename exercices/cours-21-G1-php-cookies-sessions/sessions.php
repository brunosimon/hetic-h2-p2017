<?php 

    // Afficher les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors",1);

    // Démarrage de la session
    session_start();

    // Login par défaut
    $login = !empty($_SESSION['login']) ? $_SESSION['login'] : '';

    // Si donnée envoyée, on sauvegarde le nouveau login
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
    <title>Cours 21 - G1 - Sessions</title>
</head>
<body>
    <?php if(!empty($login)): ?>
        <p>Bonjour <?php echo $login; ?></p>
    <?php endif; ?>

    <form action="#" method="POST">
        <input type="text" name="login" />
        <input type="submit">
    </form>
</body>
</html>









