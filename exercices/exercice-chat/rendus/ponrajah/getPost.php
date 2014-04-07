<?php

require_once(__DIR__ . "/classes/managers/PDOPostManager.class.php");
require_once(__DIR__."/classes/managers/PDOUserManager.class.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location: home.php");
}



$chatManager = new PDOChatManager();



    echo $chatManager->jsonPost();


?>

