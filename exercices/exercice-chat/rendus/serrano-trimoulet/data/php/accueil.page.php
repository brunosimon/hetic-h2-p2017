<?php
	if(isset($_SESSION['login'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php?page=chat">';
		die();
	}
	if(!empty($_POST)){
		$pseudo = $_POST['pseudo'];
		$_SESSION['login'] = $_POST['pseudo'];
		echo '<meta http-equiv="refresh" content="0; URL=index.php?page=chat">';
	}
?>
<div class="container">
	<form action="#" method="POST">
		<input class="pseudo" type="text" placeholder="Votre Pseudo" name="pseudo">
		<input class="btn-home" type="submit" value="GO !">
	</form>
</div>