<?php
	require_once "connect.php";
	session_start();
	if (!isset($_SESSION["pseudo"]) | empty($_SESSION["pseudo"])) {
		header("location:index.php");
	}

	// Recover messages from DB
	$query = $pdo->query("SELECT * FROM messages ORDER BY date");
	$entres = $query->fetchALL();

	

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Chat</title>
</head>
<body>
	<div id="conteneur">
		<h1>Bienvenue sur PHP Chat, votre nom de troll est <?php echo $_SESSION["pseudo"]; ?></h1>

		<div id="tchat" style="height:100%; overflow-y:scroll">
			
			

		</div>
	
		<div class="tchatForm">
			<form method="POST" action="#">
				<div> 
					<input name="message" class="message">
				</div>
				<div>
					<input type="submit" value="Envoyer">
				</div>
			</form>
		</div>
		<div class="debug"></div>
	</div>
	<script type="text/javascript" src="jquery.js"></script>
	<script type="text/javascript" src="tchat.js"></script>
</body>
</html>





