<?php 

// setcookie('mon_cookie','ma_valeur',time() + 60 * 60 * 1);

    $lang = '';

    if(isset($_COOKIE['lang']))
    {
        $lang = $_COOKIE['lang'];
    }

    if(isset($_GET['lang']))
    {
        $lang = $_GET['lang'];
        setcookie('lang',$lang,time() + 60 * 60 * 24,'/');
    }



?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Cours 21 - G2 - Cookies</title>
</head>
<body>
    <?php echo empty($lang) ? 'Choississez votre langue : ' : 'Votre langue est '.$lang; ?>
    <br /><a href="?lang=fr">FR</a>
    <br /><a href="?lang=en">EN</a>
    <br /><a href="?lang=it">IT</a>
    <br /><a href="?lang=ru">RU</a>
</body>
</html>