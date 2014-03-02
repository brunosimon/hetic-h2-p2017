<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="style.css" />
	<title>Sondage</title>
</head>

<body>
	<div class="carre0"><p class="sond"> SONDAGE </br> Gourmet </p> </div>
	<div class="carre1">
		<?php
		if( isset($_GET['err_no']) && $_GET['err_no'] == "304" ) {
			echo "<p class=\"info\">Saisissez votre nom !</p>";
		}
		?>
	<form action="sondage.php" method="post"> 

            	<input type="text" name="nom" id="nom" placeholder=" Votre nom"/>
          	</br><input type="submit" name="valide" value="valider" id="valider"/>
	</form>
</div>
		
</body>
</html>