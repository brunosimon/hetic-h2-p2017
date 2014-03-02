<?php
	if (!empty($_POST)){
		$question = new Questionnaire();
		$question->insert($_POST);
		if ($result){
			switch ($result){
				case 'ERROR_IP':
					$message = "
					<div class=\"alert alert-danger\">
		     			Votre IP existe déjà.
		    		</div>";
		    		break;
				case 'GOOD' :
					$message = "
					<div class=\"alert alert-success\">
		     			Votre réponse vient d'être ajouté dans notre base de donnée ! Merci beaucoup.
		    		</div>";
			}
		}
	}
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron">
	<h1>Dieudonné</h1>
	<p>Dieudonné M'bala M'bala, dit Dieudonné, est un humoriste, acteur et militant politique français né le 11 février 1966 à Fontenay-aux-Roses.</p>
	<p><a href="http://fr.wikipedia.org/wiki/Dieudonn%C3%A9" class="btn btn-primary btn-lg" role="button">Wikipédia &raquo;</a></p>
</div>

<div class="panel panel-danger">
  <div class="panel-heading">
    <h3 class="panel-title">Erreurs</h3>
  </div>
  <div class="panel-body">
  </div>
</div>

<div class="page-header">
		<h1>Questionnaire</h1>
	</div>
	<?php if (isset($message)){echo $message;} ?>
	<section class="col-md-6 col-md-offset-3">
	<form class="form-horizontal" role="form" method="POST" action="#" id="questionnaire">
	 
	  	<div class="form-group">
	  		<div class="row">
				 <label for="question_1" class="">1 - Votre Email</label>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="email" name="question_1" placeholder="Email">
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_2" class="">2 - Votre Sexe</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_2" value="homme">
	  		    Homme
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_2" value="femme">
	  		    Femme
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_3" class="">3 - Approuvez-vous Dieudonné ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_3" value="oui">
	  		    Oui
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_3" value="non">
	  		    Non
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_4" class="">4 - Pensez vous que le gouvernement en fait 'trop' pour le faire taire ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_4" value="oui">
	  		    Oui
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_4" value="non">
	  		    Non
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_5" class="">5 - Quelle opinion avez-vous de Dieudonné ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_5" value="mauvaise">
	  		    Mauvaise
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_5" value="partager">
	  		    Plutôt partagé
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_5" value="bonne">
	  		    bonne
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_6" class="">6 - D'après-vous fau il intedire son spéctacle ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_6" value="oui">
	  		    Oui
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_6" value="maybe">
	  		    Pas entièrement
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_6" value="non">
	  		    Non
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_7" class="">7 - Connaissiez-vous l'humoriste avant cette polémique ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_7" value="oui">
	  		    Oui
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_7" value="non">
	  		    Non
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_8" class="">8 - Cela impact-il la liberté d'expression d'après-vous ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_8" value="oui">
	  		    Oui
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_8" value="non">
	  		    Non
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_9" class="">9 - Pensez-vous que Manuel Valls a fait de la publicité à Dieudonné ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_9" value="oui">
	  		    Oui
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_9" value="non">
	  		    Non
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_10" class="">10 - Donnez une note aux caractèristiques suivants : (Du plus faible 0 au plus fort 5)</label>
	  		</div>
	  		<div class="table-responsive">
			  <table class="table">
			  	<thead>
				    <tr>
						<th class="col-sm-5"></th>
						<th>0</th>
						<th>1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
				    </tr>
			    </thead>
			    <tr>
					<td>Partage des Connaissances</td>
					<td><input type="radio" name="question_10_1" value="0"></td>
					<td><input type="radio" name="question_10_1" value="1"></td>
					<td><input type="radio" name="question_10_1" value="2"></td>
					<td><input type="radio" name="question_10_1" value="3"></td>
					<td><input type="radio" name="question_10_1" value="4"></td>
					<td><input type="radio" name="question_10_1" value="5"></td>
			    </tr>
			    <tr>
					<td>Humour fin</td>
					<td><input type="radio" name="question_10_2" value="0"></td>
					<td><input type="radio" name="question_10_2" value="1"></td>
					<td><input type="radio" name="question_10_2" value="2"></td>
					<td><input type="radio" name="question_10_2" value="3"></td>
					<td><input type="radio" name="question_10_2" value="4"></td>
					<td><input type="radio" name="question_10_2" value="5"></td>
			    </tr>
			    <tr>
					<td>Provocateur</td>
					<td><input type="radio" name="question_10_3" value="0"></td>
					<td><input type="radio" name="question_10_3" value="1"></td>
					<td><input type="radio" name="question_10_3" value="2"></td>
					<td><input type="radio" name="question_10_3" value="3"></td>
					<td><input type="radio" name="question_10_3" value="4"></td>
					<td><input type="radio" name="question_10_3" value="5"></td>
			    </tr>
			  </table>
			</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_11" class="">11 - Sur quel support avez vous entendu parler de cette affaire ?</label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_11" value="social_network">
	  		    Réseaux Sociaux
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_11" value="television">
	  		    Télévision
	  		  </label>
	  		</div>
	  		<div class="radio">
	  		  <label>
	  		    <input type="radio" name="question_11" value="paper">
	  		    Journaux
	  		  </label>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="question_12" class="">12 - Quel degré de confiance accordez vous à vos informations sur Dieudonné ? </label>
	  		</div>
	  		<div class="table-responsive">
			  <table class="table text-center">
			  	<thead>
			  		<th class="col-sm-3 text-center"></th>
			  		<th class="text-center">1</th>
			  		<th class="text-center">2</th>
			  		<th class="text-center">3</th>
			  		<th class="text-center">4</th>
			  		<th class="col-sm-3 text-center"></th>
			  	</thead>
			  	<tr>
			  		<td>-</td>
					<td><input type="radio" name="question_12" value="0"></td>
					<td><input type="radio" name="question_12" value="0"></td>
					<td><input type="radio" name="question_12" value="0"></td>
					<td><input type="radio" name="question_12" value="0"></td>
					<td>+</td>
			  	</tr>
			  </table>
			</div>
	    </div>
	   <button type="submit" class="btn btn-success btn-lg btn-block">Envoyer le Formulaire</button>
	</form>
</section>