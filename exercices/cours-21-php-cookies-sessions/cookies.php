<?php
    
    if(!empty($_COOKIE['lang']))
        $lang = $_COOKIE['lang'];

    if(!empty($_GET['lang']))
    {
        $lang = $_GET['lang'];
        setcookie('lang',$lang,time() + 60 * 10,'/');
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 21 - Cookies</title>
</head>
<body>
    <?php echo !empty($lang) ? 'Votre langue est '.$lang : 'Vous n\'avez pas encore choisi votre langue'; ?>
    <br /><a href="?lang=fr">FR</a>
    <br /><a href="?lang=en">EN</a>
    <br /><a href="?lang=es">ES</a>
    <br /><a href="?lang=it">IT</a>
</body>
</html>