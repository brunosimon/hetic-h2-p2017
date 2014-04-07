<?php
    include('config.php');
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tchat PHP</title>
    <link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Oswald:400,300|Raleway:400,300' rel='stylesheet' type='text/css'>
</head>
<body>
    <div class="content">
	    <h1>Entrez votre pseudo !</h1>
	    <form action="chat.php" method="GET">
	        <input type="text" name="pseudo" class="champ_pseudo"><br />
	        <input type="submit" value="GO !" class="btn_open">
	    </form>
	</div>
</body>
</html>