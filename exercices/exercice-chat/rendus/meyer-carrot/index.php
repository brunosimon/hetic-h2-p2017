<?php
    include('config.php');
?>

<!doctype html>
<html lang="en">
	<head>
	    <meta charset="UTF-8">
	    <link rel="stylesheet" type="text/css" href="style/style.css" /> 
	    <link href='http://fonts.googleapis.com/css?family=Share+Tech' rel='stylesheet' type='text/css'>
	    <link href='http://fonts.googleapis.com/css?family=Candal' rel='stylesheet' type='text/css'>
	    <title>Easy Chat</title>
	</head>
	<body id="home-page">
		<div id="welcome-title">
			<h1>EASY CHAT<h1>
		</div>
    	<div id="login-container">
        	<form id="welcome-form" action="rooms.php" method="GET">
           		<input id="login" type="text" name="pseudo" placeholder="Login"> 
        		</br>
        		<input id="go" type="submit" value="CHAT">
    		</form>
    	</div>
	</body>
</html>
