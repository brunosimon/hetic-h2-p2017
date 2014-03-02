<?php 
	require_once '../incs/config.php';

	if (!empty($_POST)) {
		$id = $_POST['survey_id'];
		if ($_POST['action']) {
			$req = $pdo->prepare('UPDATE surveys SET validated=1 WHERE id=:id');
			$req->bindvalue(':id', $id, PDO::PARAM_INT);
			$req->execute();

		}
		else {
			$req = $pdo->prepare('DELETE FROM surveys WHERE id=:id');
			$req->bindvalue(':id', $id, PDO::PARAM_INT);
			$req->execute();
		}
	}
?>