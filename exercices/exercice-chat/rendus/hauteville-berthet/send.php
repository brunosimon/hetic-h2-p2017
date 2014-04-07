<?php 

session_start();
require_once 'config.php';

// Test s'il y a des données envoyée en POST
if(!empty($_POST['message']))
{
	$roomID = $_GET["roomID"];
	$id = $_SESSION['id'];
	$result = $pdo->exec("INSERT INTO messages (message,user_id,room_id) VALUES ('".addslashes($_POST['message'])."','".$id."','".$roomID."')");
    // Gérer la sauvegarde du message ici
    // Profitez-en pour vous assurer que le message est bien formaté
    die('message : '.$_POST['message']);
}