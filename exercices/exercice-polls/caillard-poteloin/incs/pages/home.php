<section class="cold-md-12">
	<p><a href="newsurvey.html">Create a survey</a></p>
</section>

<section class="row">
	<section class="col-md-4">
		<h3>Last surveys</h3>

		<?php $req = $pdo->query('SELECT id, name FROM surveys WHERE validated=1 ORDER BY id DESC LIMIT 0, 10'); ?>
		<?php if ($req): ?>
			<?php while($survey = $req->fetch()): ?>
					<h4><a href="survey-<?php echo $survey['id'] ?>.html"><?php echo $survey['name']; ?></a></h4>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>
	<section class="col-md-4">
		<h3>Last votes</h3>

		<?php $reqVotes = $pdo->query('SELECT * FROM votes ORDER BY id DESC LIMIT 0, 10'); ?>
		<?php if ($req): ?>
			<?php while($vote = $reqVotes->fetch()): ?>
					<?php 
						$reqSurvey = $pdo->prepare('SELECT * FROM surveys WHERE id=:id'); 
						$reqSurvey->bindvalue(':id', $vote['survey_id'], PDO::PARAM_INT);
						$reqSurvey->execute();
						$currentSurvey = $reqSurvey->fetch();
					?>
					<p>• <?php echo $vote['value'];?> in: 
					<a href="survey-<?php echo $vote['survey_id'] ?>.html"><?php echo $currentSurvey['name']; ?></a></p>
			<?php endwhile; ?>
		<?php endif; ?>
	</section>

	<section class="col-md-4">
		<?php 
			if (!empty($_POST['seach'])):
				$request = strip_tags(trim($_POST['search']));
				$searchReq = $pdo->query("SELECT id, name FROM surveys WHERE validated = 1 AND name COLLATE UTF8_GENERAL_CI LIKE '%$request%'");
				$rows = $searchReq->rowCount();
				?>
				<h3>Search results</h3>

				<?php if (!$rows): ?>
					<p>Their is no survey about it, <a href="newsurvey.html">creat it</a>!</p>
				<?php endif; ?>
				<?php while($results = $searchReq->fetch()): ?>
					<h4><a href="survey-<?php echo $results['id'] ?>.html"><?php echo $results['name']; ?></a></h4>
				<?php endwhile; ?>
		<?php endif; ?>
		<h3>Search a survey</h3>

		<form action="#" method="post">
			<div class="form-group">
				<input type="text" name="search" id="search" placeholder="Keywords" 
				<?php if (!empty($_POST['search'])) { $request = strip_tags(trim($_POST['search'])); echo 'value="'.$request.'"'; } ?>>
			</div>
			<div class="form-group">
				<input type="submit" class="btn btn-success" value="Search!">
			</div>
		</form>
	</section>
</section>

<section class="row" >
	<section class="col-md-4 unanswered">
		<?php include 'incs/getunanswered.php' ?>
		<?php if (isset($unanswered) && !empty($unanswered)): ?>
			<h3>Unanswered surveys</h3>
			<?php foreach ($unanswered as $key): ?>
				<p>• <a href="survey-<?php echo $key['id']; ?>.html"><?php echo $key['name']; ?></a></p>
			<?php endforeach; ?>
		<?php endif; ?>
	</section>
</section>
