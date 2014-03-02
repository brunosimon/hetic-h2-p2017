<?php $survey = new Survey(); ?>
<div class="page-header">
	<h1>Liste des Questionnaires</h1>
</div>
<section class="col-md-6 col-md-offset-3">
<div class="table-responsive">
  <table class="table">
  	<thead>
	    <tr>
			<th>Nom</th>
			<th class="text-right">Lien</th>
	    </tr>
    </thead>
    <tr>	
		<td>Dieudonné</td>
		<td class="text-right"><a href="index.php?page=dieudonnee" class="btn btn-success btn-xs">Voter !</a></td>
    </tr>
    <?php $survey->select_all(); ?>
  </table>
</div>
</section>