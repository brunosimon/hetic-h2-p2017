<?php
require_once '../incs/config.php';
?>
<!doctype html>
<html>

<?php //echo realpath('viewsurveys.php'); ?>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Epic Surveys</title>
		<link rel="stylesheet" href="../assets/flatstrap/css/bootstrap.css">
		<link rel="stylesheet" href="../assets/css/style.css">
	</head>
	<body>
		<div class="wrap">
			<div class="container">
				<h1><a href="../index.php">EpicSurveys</a></h1>

				<h2>Validate or delete a survey</h2>

				<div class="col-md-12 survey-validation">

					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Name</th>
								<th>Choice 1</th>
								<th>Choice 2</th>
								<th>Choice 3</th>
								<th>Choice 4</th>
								<th>Choice 5</th>
								<th>Validate</th>
								<th>Delete</th>
							</tr>
						</thead>
						<tbody>
						<?php $req = $pdo->query('SELECT * FROM surveys WHERE validated=0 ORDER BY id DESC LIMIT 0, 20'); ?>
						<?php if ($req): ?>
							<?php while($survey = $req->fetch()): ?>
								<?php 
									foreach($survey as $key => $value) {
										if(empty($value))
											unset($survey[$key]);
									}
								?>
									<tr id="survey-id-<?php echo $survey['id']; ?>">
										<th><?php echo $survey['name']; ?></th>
										<td><span class="survey-choices"><?php echo $survey['choice1']; ?></span></td>
										<td><span class="survey-choices"><?php echo $survey['choice2']; ?></span></td>
										<td>
										<?php if (!empty($survey['choice3'])): ?>
											<span class="survey-choices"><?php echo $survey['choice3']; ?></span>
										<?php endif; ?>
										</td>
										<td>
										<?php if (!empty($survey['choice4'])): ?>
											<span class="survey-choices"><?php echo $survey['choice4']; ?></span>
										<?php endif; ?>
										</td>
										<td>
										<?php if (!empty($survey['choice5'])): ?>
											<span class="survey-choices"><?php echo $survey['choice5']; ?></span>
										<?php endif; ?>
										</td>

										<td><button class="validate-survey btn btn-success" data-action="1" data-id="<?php echo $survey['id']; ?>">Validate</button></td>
										<td><button class="validate-survey btn btn-danger" data-action= "0" data-id="<?php echo $survey['id']; ?>">Delete</button></td>
									</tr>
							<?php endwhile; ?>
						<?php endif; ?>
						<tbody>
					</table>
				</div>


				<div class="col-md-4">
					<h3>Stats</h3>
					<?php 
						$nbSurveys =  $pdo->query("SELECT COUNT(ID) FROM surveys")->fetchColumn();
						echo '<p><strong>Surveys</strong>: '.$nbSurveys;
						$nbComments =  $pdo->query("SELECT COUNT(ID) FROM votes")->fetchColumn();
						echo '<p><strong>Votes</strong>: '.$nbComments;
					?>
				</div>
			</div>
		</div>

		<footer>
			<div class="container"><p>Administration EpicSurvey | HETIC P2017</p></div>
		</footer>
		<script src="../assets/js/jquery-2.1.0.js"></script>
		<script src="../assets/flatstrap/js/bootstrap.min.js"></script>		
		<script src="js/validatesurvey.js"></script>
	</body>
</html>