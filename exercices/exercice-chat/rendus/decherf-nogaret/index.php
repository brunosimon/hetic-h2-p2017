<?php
	if(!empty($_POST) && isset($_POST["pseudo"]) && !empty($_POST["pseudo"])) {
		session_start();
		$_SESSION["pseudo"] = $_POST["pseudo"];
		header("location:tchat.php");
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="style/style.css">
	<link href='http://fonts.googleapis.com/css?family=Share+Tech+Mono' rel='stylesheet' type='text/css'>

	<title>Accueil | Troll Tchat</title>
</head>
<body>
	<div id="conteneur">
		<h1>Troll Chat</h1>
		<h2>Inscription </h2>
		<form class="inscription" action="index.php" method="POST">
			<input class="pseudotext"placeholder="Pseudo" name="pseudo">
			<input class="submit-button" type="submit" value="Troll">
		</form>
	</div>
</body>
</html>