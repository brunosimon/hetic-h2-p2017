<?php 

session_start();
require_once 'config.php';

// Test s'il y a des données envoyée en POST
if(!empty($_POST['message']))
{

	$id = $_SESSION['id'];
	$result = $pdo->exec("INSERT INTO messages (message,user_id) VALUES ('".addslashes($_POST['message'])."','".$id."')");
    // Gérer la sauvegarde du message ici
    // Profitez-en pour vous assurer que le message est bien formaté
    die('message : '.$_POST['message']);
}