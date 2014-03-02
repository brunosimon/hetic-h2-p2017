<?php 
	require_once'config.php';

	// on vide la table votes avant de commencer le sondage
	$exec = $pdo->exec('DELETE FROM votes WHERE 1');
 ?>

 <!doctype html>
 <html lang="fr">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 	<title>Quel profil d'héticien es-tu ?</title>

 	<!--  STYLES -->
 	<link rel="stylesheet" type="text/css" href="src/css/reset.css">
 	<link rel="stylesheet" type="text/css" href="src/css/style.css">
 </head>

 <body>
 	<!-- RANDOM BG -->
 	<script>
	    var bgcolorlist = new Array("#70a136","#3894a8","#c59150","#827bd3","#de9bcd","#349c93","#bbcc65","#c77a57");
	    var randomColor = bgcolorlist[Math.floor(Math.random()*bgcolorlist.length)];
	    document.body.style.background = randomColor;
	</script>

	<div class="img_container">
		<span class="img1">
			<img src="src/img/mainbubble/developer.png" alt="marketer" class="mainbubble">
			<img src="src/img/character/developer.png" alt="developer" class="maincharacter">
		</span>
		<span class="img2">
			<img src="src/img/character/designer.png" alt="designer" class="maincharacter">
			<img src="src/img/mainbubble/designer.png" alt="marketer" class="mainbubble">
		</span>
		<span class="img3">
			<img src="src/img/character/marketer.png" alt="marketer" class="maincharacter">
			<img src="src/img/mainbubble/marketer.png" alt="marketer" class="mainbubble">
		</span>
	</div>
 	<p class="welcome"> Et toi quel est ton profil ? </p>
 	<form action="index.php?question=1" method="post" class="form" onsubmit="window.location.reload()">
 		<br /><input type="submit" class="submit" value="START" >
 	</form>
 </body>
 </html>