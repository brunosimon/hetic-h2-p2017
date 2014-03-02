<?php require_once('incs/surveymanager.php'); ?>
<?php if (!empty($survey) && !empty($survey['validated'])): ?>
<section class="row" >
	<section class="survey col-md-10 col-md-offset-1">
		<h2><?php echo $survey['name']; ?></h2>
		
		<?php if (isset($error_vote) && !$error_vote): ?>
			<p class="alert alert-success">
				Thank you!
				<?php include 'incs/getunanswered.php' ?>
				<?php if (isset($unanswered) && !empty($unanswered)): ?>
					Answer other surveys: 
					<?php foreach ($unanswered as $key): ?>
						<a class="other-surveys" href="survey-<?php echo $key['id']; ?>.html"><?php echo $key['name']; ?></a>
					<?php endforeach; ?>
				<?php endif; ?>
			</p>
		<?php endif; ?>

		<?php if (isset($error_vote) && $error_vote): ?>
			<p class="alert alert-warning">Ooops, something wrong happened, can you vote again please?</p>
		<?php endif; ?>

		<?php if ($votes == 0): ?>
			<p class="alert alert-info">Be the first to vote on this survey!</p>
		<?php else: ?>
			<section class="results">
				<section class="chart-container"><canvas id="results-chart" width="300" height="300"></canvas></section>
				<section class="legend"></section>
			</section>
		<?php endif; ?>

		<p class="survey-description"><?php echo $survey['description']; ?></p>
		
		<form action="#" method="post" class="vote-form">
			<div class="form-group">
				<?php if($userVoted): ?>
					<p>You have alreay voted for "<?php echo $oldVote['value']; ?>" on this survey but you can update your choice:</p>
				<?php endif; ?>
				<?php foreach ($choices as $key => $choice): ?>
					<input type="radio" name="choice" id="<?php echo $choice ?>" value="<?php echo $choice ?>">
					<label for="<?php echo $choice ?>"><?php echo $choice ?></label>
				<?php endforeach; ?>
			</div>
			<div class="form-group">
				<input type="submit" value="Vote!" class="btn btn-success">
			</div>
		</form>
	</section>
</section>
<?php else: ?>
	<?php include "incs/pages/404.php" ?>

<?php endif; ?>