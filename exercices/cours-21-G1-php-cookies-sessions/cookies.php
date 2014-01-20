<?php

    // Afficher les erreurs
    error_reporting(E_ALL);
    ini_set("display_errors",1);

    // Par défaut
    $lang = '';

    // Depuis cookies
    if(!empty($_COOKIE['lang']))
    {
        $lang = $_COOKIE['lang'];
    }

    // Depuis get
    if(!empty($_GET['lang']))
    {
        $lang = $_GET['lang'];

        // Création du cookie
        setcookie('lang',$lang,time() + 60 * 60 * 24 * 10,'/');
    }

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 21 - G1 - Cookies</title>
</head>
<body>
    <p><?php echo empty($lang) ? 'Choisissez votre langue' : 'Votre langue est : '.$lang; ?></p>
    <br /><a href="?lang=fr">FR</a>
    <br /><a href="?lang=en">EN</a>
    <br /><a href="?lang=it">IT</a>
    <br /><a href="?lang=ru">RU</a>
</body>
</html>













