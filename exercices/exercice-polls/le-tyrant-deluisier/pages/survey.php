<?php
	if (!isset($_SESSION['id'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php?page=need_connect">';
		die();
	}
	else{
		if (isset($_GET['id'])){
			$survey = new Survey();
			if (!empty($_POST['choice'])){
				$survey->add_vote($_SESSION['id'], $_GET['id'], $_POST['choice']);
				$message = "
				<div class=\"alert alert-success\">
				Féliciation vous venez de voter !
				</div>";
			}
		}
	}
?>
<script>
	var pieData = [<?php $survey->select_votes($_GET['id']); ?>];
</script>
<div class="page-header">
	<h1>Questionnaire sur : <?php $survey->select_name($_GET['id']); ?></h1>
	<h5><?php $survey->select_description($_GET['id']); ?></h5>
</div>
<section class="col-md-6 text-center">
	<canvas id="canvas" height="450" width="450"></canvas>
		<?php $survey->select_choice('choice_1', $_GET['id']); ?>
		<?php $survey->select_choice('choice_2', $_GET['id']); ?>
		<?php $survey->select_choice('choice_3', $_GET['id']); ?>
		<?php $survey->select_choice('choice_4', $_GET['id']); ?>
		<?php $survey->select_choice('choice_5', $_GET['id']); ?>
</section>
<section class="col-md-6" style="padding-top: 250px;">
	<?php if (isset($message)){ echo $message;} ?>
	<form class="form-horizontal" role="form" method="POST" action="#">
		<div class="form-group text-center">
			<?php $survey->select_issues($_GET['id']); ?>
	    </div>
	    <input type="submit" class="btn btn-success btn-lg btn-block" value="Envoyer le Formulaire">
	</form>
</section>