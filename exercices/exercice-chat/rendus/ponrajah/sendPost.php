<?php
require_once(__DIR__ . "/classes/managers/PDOPostManager.class.php");
require_once(__DIR__."/classes/managers/PDOUserManager.class.php");
session_start();

if(!isset($_SESSION["user"])){
    header("location: home.php");
}

if(isset($_REQUEST["message"])){

    $message = $_REQUEST["message"];

}

$id_user = $_SESSION["user"]->getId();

$pdoPost = new PDOChatManager();
$pdoPost->sendPost($id_user,$message);

