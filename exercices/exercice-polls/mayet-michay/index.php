<?php
	include 'src/includes/config.php';
	include 'src/includes/functions.php';
	include 'src/includes/display_functions.php';
	include 'src/includes/process_form.php';
?>
<!doctype html>
<html lang="fr">
<head>
	<meta charset="UTF-8">
	<title>Quel superhéro sommeille en toi ?</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="src/css/reset.css">
	<link rel="stylesheet" href="src/css/main.css">
</head>
<body>	
	<div class="progress" style="width:<?php echo $progress;?>%"></div>
	<form action="#" method="post" class="whole-page" id="form" name="form">
		<?php
            echo '<h3>'.$question.'</h3>';
            display_answers($answers);
		?>
		<input type="hidden" name="step" value="<?php echo $_SESSION['step']; ?>">
		<input type="submit">
	</form>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="src/js/jquery-1.11.0.min.js"><\/script>')</script>
	<script src="src/js/main.js"></script>
</body>
</html>