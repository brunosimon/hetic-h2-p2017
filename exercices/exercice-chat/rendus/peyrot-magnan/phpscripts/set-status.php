<?php
session_start();
include('functions.php');
$db = db_connect();

if(!user_verified()) {
	$insert = $db->prepare('
		UPDATE chat_online SET online_status = :status WHERE online_user = :user
	');
	$insert->execute(array(
		'status' => $_POST['status'],
		'user' => $_SESSION['id']		
	));
}
?>