<?php
$surveyId = $_GET['id']; 


if (empty($_SESSION['name'])) {
	$error_vote = 1;
}
else {
	// CHECK IF THE USER VOTED
	$userVoted = 0;
	$req = $pdo->prepare('SELECT * FROM votes WHERE survey_id=:survey_id AND user_token=:token');
	$req->bindvalue(':survey_id', $surveyId, PDO::PARAM_INT);
	$req->bindvalue(':token', $_SESSION['token'], PDO::PARAM_STR);
	$req->execute();
	$oldVote = $req->fetch();
	if (!empty($oldVote)) {
		$userVoted = 1;
	}

	// GET SURVEY VALUES
	$req = $pdo->prepare('SELECT * FROM surveys WHERE id=:id');
	$req->bindvalue(':id', $surveyId, PDO::PARAM_INT);
	$req->execute();	
	$survey = $req->fetch();

	if (!empty($survey)) {	
		$choices = array (
				'choice1' => $survey['choice1'],
				'choice2' => $survey['choice2'],
				'choice3' => $survey['choice3'],
				'choice4' => $survey['choice4'],
				'choice5' => $survey['choice5']
			);
		foreach($survey as $key => $value) {
			if(empty($value))
				unset($survey[$key]);
		}
		foreach($choices as $key => $value) {
			if(empty($value))
				unset($choices[$key]);
		}
	}

	// ADD DATA
	if (!empty($_POST)) {
		$userChoice = $_POST['choice'];
		$error_vote = 1;
		foreach ($choices as $key => $choice) {
			if ($userChoice == $choice) {
				$error_vote = 0;
				break;
			}
		}
		if (!$error_vote) {
			if ($userVoted) {
				$req = $pdo->prepare('UPDATE votes SET value = :value WHERE survey_id=:survey_id AND user_token=:user_token');
				$req->bindvalue(':value', $userChoice, PDO::PARAM_STR);
				$req->bindvalue(':survey_id', $surveyId, PDO::PARAM_INT);
				$req->bindvalue(':user_token', $_SESSION['token'], PDO::PARAM_STR);
				$req->execute();
			}
			else {
				$req = $pdo->prepare('INSERT INTO votes(survey_id, value, user_token) VALUES (:survey_id, :value, :user_token)');
				$req->bindvalue(':value', $userChoice, PDO::PARAM_STR);
				$req->bindvalue(':survey_id', $surveyId, PDO::PARAM_INT);
				$req->bindvalue(':user_token', $_SESSION['token'], PDO::PARAM_STR);
				$req->execute();

				// UPDATE VOTE INFOS TO DISPLAY IT
				$userVoted = 1;
			}
			$oldVote['value'] = $userChoice;

		}
	}

	// GET ALL THE VOTE VALUES
	$allVotes = array();
	$req = $pdo->prepare('SELECT value FROM votes WHERE survey_id=:survey_id');
	$req->bindvalue(':survey_id', $surveyId, PDO::PARAM_INT);
	$req->execute();	
	while($votes = $req->fetch()) {
		$allVotes[] = $votes['value'];
	}
	if (!empty($allVotes)) {
		$votesCount = array_count_values($allVotes);
		$votes = 1;
		$jsonVotes = array();
		foreach ($votesCount as $key => $value) {
			$jsonVotes['"'.$key.'"'] = $value;
		}
		$jsonVotes = json_encode($jsonVotes);
	}	
	else {
		$votes = 0;
	}	
}
	