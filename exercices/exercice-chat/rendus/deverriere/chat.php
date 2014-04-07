<?php 
	session_start();
	require_once 'src/includes/config.php'; 
	require_once 'src/includes/functions.php'; 
	$printQuizz = printQuizz();
?>
<!doctype html>
<html lang="fr-FR">
<head>
	<meta charset="UTF-8">
	<title>Chat</title>
	<link rel="stylesheet" type="text/css" href="src/css/reset.css">
    <link rel="stylesheet" type="text/css" href="src/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="src/css/custom.css">
</head>
<body>
	<div class="questions">
		<?php if(!empty($printQuizz)): ?>

			<ul>
				<?php foreach($printQuizz as $_printQuizz): ?>
					<li><?php echo $_printQuizz->nom; ?></li>
				<?php endforeach; ?>
			</ul>
		<?php endif; ?>
	</div>
	<div class="container">
		<div class="tchat"></div>
		<div class="tchat-form">
			<form action="#" method="post">
				<input type="text" name="content" class="content" required="required"/>
				<button type="submit" class="btn btn-primary">
				  Envoyer
				</button>
			</form>
			<a href="inscription.php" class="btn btn-primary">
				Déconnexion
			</a>
		</div>
	</div>
	<a href="quizz.php">Crée tes propres questions ! </a>
	</div>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src="src/js/ajax.js"></script>
</body>
</html>