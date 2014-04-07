<?php
session_start();
require_once(__DIR__."/classes/managers/PDOUserManager.class.php");

if(isset($_SESSION["user"])){
    header("location: index.php");
}

if(isset($_REQUEST["pseudo"]) && isset($_REQUEST["password"]) && isset($_REQUEST["confirmation"])){
    $pseudo = $_REQUEST["pseudo"];
    $password = $_REQUEST["password"];
    $confirmation = $_REQUEST["confirmation"];

    $userManager = new PDOUserManager();
    $userManager->registration($pseudo,$password,$confirmation);

    $message = $userManager->getMessage();

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../assets/ico/favicon.ico">

    <title>Jumbotron Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap-3.1.1-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.1.1-dist/css/chat.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="jumbotron.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <img src="bootstrap-3.1.1-dist/img/chat-icon.png" width="40">
        </div>
        <div class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" role="form">
                <div class="form-group">
                    <input type="text" placeholder="Email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</div>

<!-- Main jumbotron for a primary marketing message or call to action -->
<div class="jumbotron header">
    <div class="container">
        <h2>Inscris toi, et rejoins les millions d'utilisateurs déjà présent !</h2>

    </div>
</div>

<div class="container">
    <form  id="form-register" method="POST" >

        <input type="text" name="pseudo" placeholder="pseudo" class="form-control"  /> <br />
        <input type="password" name="password" class="form-control" placeholder="Mot de passe" /> <br />
        <input type="password" class="form-control" name="confirmation" placeholder="Confirmation" /> <br />
        <input type="submit"  class="btn btn-primary" value="Inscription" name="inscription" /> <br /> <br />

        <div class="message">
            <?php
            if(isset($message)){
                echo $message;
            }
            ?>
        </div>
    </form>


    <hr>

    <footer>
        <p>&copy; Hetic 2014</p>
    </footer>
</div> <!-- /container -->


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="../../dist/js/bootstrap.min.js"></script>
</body>
</html>