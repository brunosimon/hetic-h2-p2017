<?php 

	error_reporting(E_ALL); 
	ini_set('display_errors', 1);

	require('../include/config.php');

	$id = $_GET['id'];

	$prepare = $pdo->prepare('DELETE FROM debates WHERE id=:id');
	$prepare->bindValue(':id',$id,PDO::PARAM_INT);
	$prepare->execute();

	header('Location: /');

?>