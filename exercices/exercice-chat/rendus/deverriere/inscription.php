<?php 
	require_once 'src/includes/config.php'; 
	require_once 'src/includes/functions.php';
	$mess = '';
	if(!empty($_POST)) $mess = checkInscription($_POST);
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
		<form action="#" method="post">
            <h2>Inscription</h2>

            <div>
                <span>Pseudo</span>
                <input type="text" name="login">
            </div>

            <div>
              <span class="add-on">Mot de passe</span>
              <input type="password" name="password">
            </div>
            
            <div>
              <span class="add-on">Confirmation</span>
              <input type="password" name="verif-password">
            </div>
            
            <button type="submit" class="btn btn-primary">
             	Inscription
            </button>
            
            <?php if(!empty($mess)): ?>
            	<div>
            		<?php echo $mess ?>
            	</div>
            <?php endif; ?>
		</form>
	</div>
</body>
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
</html>