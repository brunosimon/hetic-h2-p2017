<?php $survey = new Survey(); ?>
<div class="page-header">
	<h1>Accueil</h1>
</div>
<section class="col-md-3" >
	<h4>Les derniers Sondages !</h4>
	<table class="table">
	  <tbody>
		<?php $survey->last_5(); ?>
	  </tbody>
	</table>
</section>
<section class="col-md-9">
	Bienvenue sur notre site,<br/><br/>
	Ce site permet de créer un sondage très rapidement avec une simple inscription !<br/>
	Le Sondage du jour : Dieudonné qui fait polémique ! Vous pouvez voter sans inscription pour ce sondage à cette adresse : <a href="index.php?page=dieudonnee">ici</a>.<br/>
	<br/>
	Bien cordialement,<br/>
	Mathieu & Pauline
</section>