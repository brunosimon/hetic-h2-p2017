<?php 
	session_start();
	require_once 'src/includes/config.php'; 
	require_once 'src/includes/functions.php'; 
	$return = '';
	if(!empty($_POST)) $return = checkConnection($_POST);
	if(!empty($_SESSION['login'])) header('Location:chat.php');
?>
<!doctype html>
<html lang="fr-FR">
<head>
    <meta charset="UTF-8">
    <title>Miaou</title>
    <link rel="stylesheet" type="text/css" href="src/css/reset.css">
    <link rel="stylesheet" type="text/css" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="src/css/custom.css">
</head>
<body>
	<div class="container">
		<div>
			<?php if(!empty($return)): ?>
				<div class="return">
					<?php echo $return; ?>
				</div>
			<?php endif; ?>
		</div>
		<div class="form-action panel panel-primary">
			<div class="panel-heading">
				<h2>Connexion</h2>
			</div>
			<form class="panel-body" action="#" method="post">
				<div class="form-group">
					<label>Pseudo</label>
					<input type="text" name="login">
				</div>
				<div class="form-group">
				  <label>Mot de passe</label>
				  <input type="password" name="password">
				</div>

				<button type="submit" class="btn btn-primary">
				  Go to the chat !
				</button>
			</form>
			<a href="inscription.php">Inscris toi !</a>
		</div>	
	</div>
</body>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</html>