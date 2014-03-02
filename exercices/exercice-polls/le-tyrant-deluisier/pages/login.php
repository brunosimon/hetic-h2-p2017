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
		else{
			$subscribe = new User();
			$subscribe->connect($_POST);
			$message =  "
			<div class=\"alert alert-success\">
			Connexion validé !<br/>
			Redirection dans 5secondes.
			</div>";
			echo '<meta http-equiv="refresh" content="5; URL=index.php">';
		}
	}
?>
<div class="page-header">
	<h1>Connexion</h1>
	<h5>Merci de vous inscrire avant d'essayer de vous connectez (<a href="index.php?page=inscription">Inscription</a>)</h5>
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

	    <button type="submit" class="btn btn-primary btn-lg btn-block">Envoyer le Formulaire</button>
	</form>
</section>