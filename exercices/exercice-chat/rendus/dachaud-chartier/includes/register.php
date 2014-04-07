<div class="home_header">
	<h1>Quizzy</h1>
	<h2>Le quiz 100% multijoueurs !</h2>
</div>
<div class="home_container">
	<h3>Jouez dès maintenant !</h3>
	<form class="home_form" action="#" method="POST">
		<input class="home_input" type="text" name="pseudo" placeholder="Pseudo"/>
		<input class="home_input" type="password" name="password" placeholder="Mot de passe"/>
		<input class="home_input" type="password" name="password_confirm" placeholder="Répétez le mot de passe" id="home_repeat"/>
		<input class="home_submit" type="submit" name="submit" value="C'est parti ! " id="home_submit"/>
		<input type="hidden" value="register" name="action" id="actions"/>
	</form>
	<a href="#" id="home_already">J'ai déjà un compte</a>
</div>
<script src="src/js/home_script.js"></script>