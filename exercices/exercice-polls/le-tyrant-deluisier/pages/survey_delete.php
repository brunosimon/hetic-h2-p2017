<?php 
	if(!isset($_SESSION['id'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php?page=need_connect">';
		die();
	}
	else{
		$survey = new Survey();
		if (isset($_GET['action']) && $_GET['action'] == 'delete' && $_GET['id']){
			$survey->delete_survey($_GET['id']);
		}
	}
 ?>
<div class="page-header">
	<h1>Supprimer un Questionnaire</h1>
</div>
<section class="col-md-6 col-md-offset-3">
<div class="table-responsive">
  <table class="table">
  	<thead>
	    <tr>
			<th>ID</th>
			<th class="text-center">Nom</th>
			<th class="text-right"></th>
	    </tr>
    </thead>
    <?php echo $survey->select_own_surveys($_SESSION['id']); ?>
  </table>
</div>
</section>