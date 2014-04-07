<?php
    session_start();
    require_once 'config.php'; 
    header('Content-Type: text/html; charset=utf-8');
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Quizzy - Le quiz 100% multijoueurs !</title>
    <link rel="stylesheet" type="text/css" href="src/styles/reset.css">
    <link rel="stylesheet" type="text/css" href="src/styles/style.css">
    <link rel="stylesheet" type="text/css" href="src/styles/fonts/fonts.css">
</head>
<body>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<?php
    if(!isset($_SESSION['id'])){
        if (isset($_POST['submit'])){
            include 'includes/register_ok.php';
        } else {
            include 'includes/register.php';
        }
    } else {
        include 'includes/chat.php';
    }
?>
</body>
</html>