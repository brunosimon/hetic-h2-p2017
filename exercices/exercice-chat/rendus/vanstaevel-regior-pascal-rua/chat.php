<?php 
    session_start();
    require_once 'require/config.php';
?>
<!DOCTYPE html>

<html>
<head>
  <title>Chat</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap -->
  <link href="src/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="src/css/maincss.css" rel="stylesheet" media="screen">
</head>

<body>
  <header>
    <nav class="navbar navbar-inverse">
      <div class="navbar-inner">
        <a class="brand" href="index.php">Welcome on myChat !</a>
      </div>
    </nav>
  </header>

  <h2 class="login"> Salut <?php echo $_SESSION["login"];?></h2>
  
  <ul class="message-container" id="message-container"></ul>

  <form action="#" id="formChat" method="post">
    <div class="smiley">
      <img id="smiley1" alt =":)" src='src/img/PNG/Mini-Smile.png'/>
      <img id="smiley2" alt =":D" src='src/img/PNG/Grin.png'/>
      <img id="smiley3" alt =":/" src='src/img/PNG/Slant.png'/>
      <img id="smiley4" alt =":p" src='src/img/PNG/Yuck.png'/>
      <img id="smiley5" alt =":(" src='src/img/PNG/Embarrassed.png'/>
      <img id="smiley6" alt =":o" src='src/img/PNG/Gasp.png'/>
      <img id="smiley7" alt ="(y)" src='src/img/PNG/Thumbs-Up.png'/>
    </div>
    <input class="input-chat" type="text" name="message" id="message"/>
    <input type="submit" value="Send" class="btn btn-primary">
  </form>

  <a href="deconnexion.php">Disconnect</a>

  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="src/js/bootstrap.min.js"></script>
  <script src="src/js/script.js"></script>
</body>
</html>