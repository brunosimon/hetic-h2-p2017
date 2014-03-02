<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $titre; ?></title>
	<link rel="stylesheet" href="css/style.css">
</head>
<body>

<?php
	if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){

	    echo '<header class="head">
                <div class="logotype"></div>
                <ul class="head-nav">
                    <li class="head-list"><a class="head-link" href="index.php">Accueil</a></li>
                    <li class="head-list"><a class="head-link" href="send_poll.php">Proposer un sondage</a></li>
                    <li class="head-list">
                        <a class="head-link" data-toggle="dropdown" data-target="#">Votre Compte ('.$_SESSION['first_name'].')</a>
                        <ul class="count">
                            <li>E-Mail : '.$_SESSION['email'].'</li>
                            <li><a class="btn" href ="deconnexion.php">Déconnexion</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="clear"></div>
            </header>';
    }
    else{}
?>