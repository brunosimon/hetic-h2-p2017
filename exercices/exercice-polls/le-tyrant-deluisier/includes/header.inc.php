		<?php $question = new Questionnaire(); ?>
		<!-- Fixed navbar -->
	    <div class="navbar navbar-inverse navbar-top" role="navigation">
	      <div class="container">
	        <div class="navbar-header">
	          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	            <span class="sr-only">Toggle navigation</span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	            <span class="icon-bar"></span>
	          </button>
	          <a class="navbar-brand" href="index.php?page=accueil">Your Own Survey</a>
	        </div>
	        <div class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="active"><a href="index.php?page=accueil">Accueil</a></li>
					<li><a href="index.php?page=liste_des_questionnaires">Les Questionnaires</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php
						if (isset($_SESSION['login'])){
							echo '
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Votre Compte <b class="caret"></b></a>
								<ul class="dropdown-menu">
									<li><a href="index.php?page=survey_add">Ajouter Questionnaire</a></li>
									<li><a href="index.php?page=survey_delete">Supprimer Questionnaire</a></li>
								</ul>
							</li>
							';
							echo '<li class="active"><a href="index.php?page=deconnexion">Déconnexion</a></li>';
						}
						else{
							echo '<li><a href="index.php?page=inscription">Inscription</a></li>';
							echo '<li><a href="index.php?page=login">Login</a></li>';
						}
					?>
				</ul>
	        </div>

	      </div>
	    </div>

	    <div class="container theme-showcase" role="main">