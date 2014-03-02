<?php
	if (!empty($_POST)){
		extract($_POST);
		if (empty($username)){
			$message = "
			<div class=\"alert alert-danger\">
			Nom de compte vide.
			</div>";
		}
		else if (empty($password)){
			$message = "
			<div class=\"alert alert-danger\">
			Mot de passe vide.
			</div>";
		}
		else if (empty($mail)){
			$message = "
			<div class=\"alert alert-danger\">
			Mail vide.
			</div>";
		}
		else if(!filter_var($mail, FILTER_VALIDATE_EMAIL)){  
   			$message = "
			<div class=\"alert alert-danger\">
			L'email est invalide.
			</div>";
		}
		else if ($username == $password){
			$message = "
			<div class=\"alert alert-danger\">
			Le nom de compte est le mot de passe doit être différents.
			</div>";
		}
		else if (strlen($password) < 9){
			$message = "
			<div class=\"alert alert-danger\">
			Le mot de passe doit contenir 9 caractères minimum.
			</div>";
		}
		else{
			$subscribe = new User();
			$subscribe->insert($_POST);
			$message =  "
			<div class=\"alert alert-success\">
			Inscription validé !
			</div>";
		}
	}
?>
<div class="page-header">
	<h1>Inscription</h1>
	<h5>L'inscription est nécessaire pour pouvoir créer/voter</h5>
</div>
<section class="col-md-4 col-md-offset-4">
	<?php if (isset($message)){echo $message;} ?>
	<form class="form-horizontal" role="form" method="POST" action="#">
		<div class="form-group">
	  		<div class="row">
				 <label for="username">1 - Nom de Compte</label>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="text" name="username" placeholder="PaulineDu93" required>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="username">2 - Mot de passe</label>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="password" name="password" placeholder="PaulineDu93" required>
	  		</div>
	    </div>

	    <div class="form-group">
	  		<div class="row">
				 <label for="mail">3 - Votre Mail</label>
	  		</div>
	  		<div class="row">
				 <input class="form-control" type="mail" name="mail" placeholder="PaulineDu93@gmail.com" required>
	  		</div>
	    </div>

	    <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer le Formulaire</button>
	</form>
</section>