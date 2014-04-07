<?php
	session_start();
	require_once 'src/includes/config.php';
	require_once 'src/includes/functions.php';
	$quizz = '';
	if(!empty($_POST)) $quizz = quizz($_POST, $_SESSION['login']);
?>

<!doctype html>
<html lang="fr-FR">
<head>
	<meta charset="UTF-8">
	<title>Quizz</title>
	<link rel="stylesheet" type="text/css" href="src/css/reset.css">
    <link rel="stylesheet" type="text/css" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="src/css/custom.css">
</head>
<body>
	<div class="container">
		<div class="form-action panel panel-primary">
			<div class="panel-heading">
				<h2>Crée ta question</h2>
			</div>
			<form action= "#" method="POST">
				<legend></legend>

				<div class="form-group">
				<label>Nom de votre question</label>
				<input type="text" id="name" name="name"> 
				</div>

				<div class="form-group">
				<label>Posez de votre question</label>
				<input type="text" id="question" name="question"> 
				</div>

				<div class="form-group">
				<label>Réponse(s) possible(s)</label>
				<input type="text" id="answer" name="answer"> 
				</div>

				<button type="submit" class="btn btn-primary"> 
				Enregistrer
				</button>
			</form>
			<?php if(!empty($quizz)): ?>
				<div class="error">
					<?php echo $quizz;?>
				</div>
			<?php endif; ?>
		</div>
		<a href="chat.php">Retour sur le tchat </a>
	</div>
	
		
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</body>
</html>
