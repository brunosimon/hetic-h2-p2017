<?php 
	$req = $pdo->prepare("SELECT survey_id FROM votes WHERE user_token = :token");
	if ($req) {
		$req->bindvalue(':token', $_SESSION['token'], PDO::PARAM_STR);
		$req->execute();
		$ids = array();
		while($surveyId = $req->fetch()) {
			$ids[] = $surveyId['survey_id'];
		}
		$idsString = '';

		foreach ($ids as $key => $value) {
			$idsString .= 'id != :id'.($key+1);
			if (($key+1)<sizeof($ids))
				$idsString .=' AND ';
		}

		$reqUnanswered = $pdo->prepare("SELECT id, name FROM surveys WHERE validated=1 AND ".$idsString." ORDER BY id DESC LIMIT 0, 5");
		if ($reqUnanswered) {
			foreach ($ids as $key => $value) {
				$reqUnanswered->bindvalue(':id'.($key+1), $ids[$key], PDO::PARAM_INT);
			}
			$reqUnanswered->execute();
			while ($res = $reqUnanswered->fetch()) {
				$unanswered[] = array(
					'id' => $res['id'],
					'name' => $res['name']
					);
			}
		}
	}
?>