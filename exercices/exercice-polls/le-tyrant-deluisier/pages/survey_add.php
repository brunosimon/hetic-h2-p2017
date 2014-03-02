<?php
	if (isset($_SESSION['id'])){
		if (!empty($_POST)){
			extract($_POST);
			if (empty($name)){
				$message = "
				<div class=\"alert alert-danger\">
				Il manque le nom du sondage !
				</div>";
			}
			else if (empty($description)){
				$message = "
				<div class=\"alert alert-danger\">
				Il manque la description du sondage !
				</div>";
			}
			else if (empty($choice_1) || empty($choice_1)){
				$message = "
				<div class=\"alert alert-danger\">
				Vous devez remplir au moins 2 choix possible ! 
				</div>";
			}
			else{
				$survey = new Survey();
				$survey->add_survey($_POST);
				$message = "
				<div class=\"alert alert-success\">
				Votre Questionnaire a bien été ajouté !<br/>
				Redirection dans 5s
				</div>";
				echo '<meta http-equiv="refresh" content="5; URL=index.php?page=liste_des_questionnaires">';
			}
		}
	}
	else{
		echo '<meta http-equiv="refresh" content="0; URL=index.php?page=need_connect">';
		die();
	}
?>
<div class="page-header">
	<h1>Ajouter un Questionnaire</h1>
</div>
<section class="col-md-4 col-md-offset-4">
	<?php if (isset($message)){echo $message;} ?>
	<form class="form-horizontal" role="form" method="POST" action="#">
		<!-- NAME -->
		<div class="form-group">
	  		<div class="row">
				 <label for="name">1 - Question ?</label>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="name" placeholder="Les OS mobiles" required>
	  		</div>
	    </div>
		<!-- DESCRIPTION -->
	    <div class="form-group">
	  		<div class="row">
				 <label for="description">2 - Description</label>
	  		</div>
	  		<div class="row">
				 <textarea class="form-control" rows="3" name="description" required>Il en existe beaucoup, alors pour vous lequel est le meilleur ?!</textarea>
	  		</div>
	    </div>

		<!-- DESCRIPTION -->
	    <div class="form-group">
	  		<div class="row">
				 <label for="choice_1">3 - Choix</label>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="choice_1" placeholder="Android" required><br/>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="choice_2" placeholder="iOS" required><br/>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="choice_3" placeholder="Blackberry OS"><br/>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="choice_4" placeholder="Tizen"><br/>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="choice_5" placeholder="Firefox OS">
	  		</div>
	    </div>
		<input type="submit" class="btn btn-success btn-lg btn-block" value="Envoyer le Questionnaire">
	</form>
</section>