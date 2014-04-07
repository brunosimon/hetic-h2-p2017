<?php
	include('config.php');
	$select = $pdo->query("SELECT * FROM messages ORDER BY id ASC");
	echo json_encode($select->fetchAll());


	

		

	
?>