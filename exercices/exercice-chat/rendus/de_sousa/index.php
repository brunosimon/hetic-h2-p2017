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
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>Accueil PHP chat</title>
</head>
<body>
	<div id="conteneur">
		<h1>Mon Chat</h1>
		<form action="index.php" method="POST">
			Pseudo : <input type="text" name="pseudo">
			<input type="submit" value="tchatter">
		</form>
	</div>
</body>
</html>