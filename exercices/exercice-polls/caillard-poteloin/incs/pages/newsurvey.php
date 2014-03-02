<?php
	$req = $pdo->prepare('SELECT last_survey_date FROM users WHERE token = :token');
	$req->bindvalue(':token', $_SESSION['token'], PDO::PARAM_STR);
	$req->execute();
	$lastSurveyAdded = $req->fetch();
	$lastSurveyAdded = $lastSurveyAdded['last_survey_date'];
	$currentTimestamp = new DateTime();
	$currentTimestamp = $currentTimestamp->getTimestamp();

	if ($currentTimestamp-$lastSurveyAdded < 30)
		$disableForm = "You have to wait ".gmdate("i:s", 30-($currentTimestamp-$lastSurveyAdded)). " before to add a new survey.";
	else {
		$errors = array();
		$surveyAdded = false;
		function cleanData($data) {
			$data['survey-name']        = strip_tags(trim($data['survey-name']));
			$data['survey-description'] = strip_tags(trim($data['survey-description']));
			$data['choice1']            = strip_tags(trim($data['choice1']));
			$data['choice2']            = strip_tags(trim($data['choice2']));
			$data['choice3']            = strip_tags(trim($data['choice3']));
			$data['choice4']            = strip_tags(trim($data['choice4']));
			$data['choice5']            = strip_tags(trim($data['choice5']));
			return $data;
		}

		function checkData($value, $min, $max, $allowEmpty) {
			$error = null;
			if(empty($value) && !$allowEmpty)
				$error = "It can't be empty.";
			else if (strlen($value) < $min && !$allowEmpty)
					$error = "It is too short.";
			else if ($allowEmpty && strlen($value) > 0 && strlen($value) < $min)
				$error = "It is too short.";
			else if (strlen($value) > $max)
				$error = "It is too long.";
			
			return $error;
		}

		if (!empty($_POST)) {
			$data = cleanData($_POST);

			$errors['survey-name'] = checkData($data['survey-name'], 3, 50, 0);
			$errors['survey-description'] = checkData($data['survey-description'], 3, 250, 0);
			$errors['choice1'] = checkData($data['choice1'], 2, 50, 0);
			$errors['choice2'] = checkData($data['choice2'], 2, 50, 0);
			$errors['choice3'] = checkData($data['choice3'], 2, 50, 1);
			$errors['choice4'] = checkData($data['choice4'], 2, 50, 1);
			$errors['choice5'] = checkData($data['choice5'], 2, 50, 1);

			$req = $pdo->prepare('SELECT id, name FROM surveys WHERE name = :name');
			$req->bindvalue(':name', $data['survey-name'], PDO::PARAM_STR);
			$req->execute();

			if ($res = $req->fetch()) {
				$dataId = $res['id'];
				$errors['survey-name'] = 'This survey already exists';
				$disableForm = 'This survey already exists, <a href="survey-'.$dataId.'.html">please check it.</a>';
			}

			foreach($errors as $key => $value) {
				if(empty($value))
					unset($errors[$key]);
			}

			if (empty($errors)) {
				$req = $pdo->prepare('INSERT INTO surveys(name, description, choice1, choice2, choice3, choice4, choice5) VALUES (:name, :description, :choice1, :choice2, :choice3, :choice4, :choice5)');
				$req->bindvalue(':name', $data['survey-name'], PDO::PARAM_STR);
				$req->bindvalue(':description', $data['survey-description'], PDO::PARAM_STR);
				$req->bindvalue(':choice1', $data['choice1'], PDO::PARAM_STR);
				$req->bindvalue(':choice2', $data['choice2'], PDO::PARAM_STR);
				$req->bindvalue(':choice3', $data['choice3'], PDO::PARAM_STR);
				$req->bindvalue(':choice4', $data['choice4'], PDO::PARAM_STR);
				$req->bindvalue(':choice5', $data['choice5'], PDO::PARAM_STR);
				$req->execute();

				$currentTimestamp = new DateTime();
				$currentTimestamp = $currentTimestamp->getTimestamp();
				$req = $pdo->prepare('UPDATE users SET last_survey_date = :last_survey_date WHERE token = :token');
				$req->bindvalue(':last_survey_date', $currentTimestamp, PDO::PARAM_INT);
				$req->bindvalue(':token', $_SESSION['token'], PDO::PARAM_STR);
				$req->execute();

				$req = $pdo->query('SELECT id, name FROM surveys ORDER BY id DESC LIMIT 1');
				$lastSurveyId = $req->fetch();

				$surveyAdded = true;
			}
		}

	}
?>

<h2>Create a new survey</h2>

<div class="new-survey col-md-10 col-md-offset-1">

	<?php if(isset($disableForm)): ?>
		<p class="alert alert-info"><?php echo $disableForm ?></p>

	<?php else: ?>
		<?php if(!$surveyAdded): ?>
			<form action="#" method="post" id="new-survey">
				<div class="form-group">
					<?php if (!empty($errors['survey-name'])): ?>
						<div class="label label-danger"><?php echo $errors['survey-name']; ?></div>
					<?php endif; ?>
					<input type="text" name="survey-name" id="survey-name" placeholder="Survey name"
					<?php if (array_key_exists('survey-name', $_POST)) echo 'value="'.$_POST['survey-name'].'"'; ?>>
				</div>
				<div class="form-group">
					<?php if (!empty($errors['survey-description'])): ?>
						<div class="label label-danger"><?php echo $errors['survey-description'] ?></div>
					<?php endif; ?>
					<textarea name="survey-description" id="survey-description" cols="40" rows="5" placeholder="Question or short description less than 250 signs"><?php if (array_key_exists('survey-description', $_POST)) echo $_POST['survey-description']; ?></textarea>
				</div>
				<div class="form-group">
					<?php if (!empty($errors['choice1'])): ?>
						<div class="label label-danger"><?php echo $errors['choice1'] ?></div>
					<?php endif; ?>
					<input type="text" name="choice1" id="choice1" placeholder="Choice 1"
					<?php if (array_key_exists('choice1', $_POST)) echo 'value="'.$_POST['choice1'].'"'; ?>>

					<?php if (!empty($errors['choice2'])): ?>
						<div class="label label-danger"><?php echo $errors['choice2'] ?></div>
					<?php endif; ?>
					<input type="text" name="choice2" id="choice2" placeholder="Choice 2"
					<?php if (array_key_exists('choice2', $_POST)) echo 'value="'.$_POST['choice2'].'"'; ?>>


					<?php if (!empty($errors['choice3'])): ?>
						<div class="label label-danger"><?php echo $errors['choice3'] ?></div>
					<?php endif; ?>
					<input type="text" name="choice3" id="choice3" placeholder="Choice 3"
					<?php if (array_key_exists('choice3', $_POST)) echo 'value="'.$_POST['choice3'].'"'; ?>>


					<?php if (!empty($errors['choice4'])): ?>
						<div class="label label-danger"><?php echo $errors['choice4'] ?></div>
					<?php endif; ?>
					<input type="text" name="choice4" id="choice4" placeholder="Choice 4"
					<?php if (array_key_exists('choice4', $_POST)) echo 'value="'.$_POST['choice4'].'"'; ?>>


					<?php if (!empty($errors['choice5'])): ?>
						<div class="label label-danger"><?php echo $errors['choice5'] ?></div>
					<?php endif; ?>
					<input type="text" name="choice5" id="choice5" placeholder="Choice 5"
					<?php if (array_key_exists('choice5', $_POST)) echo 'value="'.$_POST['choice5'].'"'; ?>>

					<div class="add-choice"></div>
				</div>
				<div class="form-group">
					<input type="submit" value="Create a survey" class="btn btn-success">
				</div>
			</form>

		<?php else: ?>
			<p class="alert alert-succes">Your survey was sent to validation, we will check it ASAP.<br>
			<a href="index.php">Go back to homepage</a></p>
		<?php endif; ?>

	<?php endif; ?>

</div>