
<?php

mysql_select_db( "exercice-chat-goguelin" ) or die( 'Error'. mysql_error() );


include("connect.php");


// On vérifie si l'utilisateur a bien choisi un pseudo et si celui ci a bien été posté.
if(!empty($_POST) && isset($_POST["pseudo"]) && !empty($_POST["pseudo"]))
{
      //Si ces condititons sont réunies on le redirige vers la page chat.
      session_start();
      $pseudo = $_POST["pseudo"];
      $pseudo = mysql_escape_string($pseudo);
      $sql = "SELECT * FROM connected WHERE pseudo LIKE '$pseudo' LIMIT 1";
      $req = mysql_query($sql);
      $data = mysql_fetch_assoc($req);
      if(empty($data))
      {
    	 $ip = $_SERVER["REMOTE_ADDR"];
    	 $sql = "INSERT INTO connected(pseudo,ip,date) VALUES ('$pseudo','$ip',".time().")";
    	 $req = mysql_query($sql) or die(mysql_error());
    	 $idTchat = mysql_insert_id();
      }
      else
      {
    	   if($data["ip"] == $_SERVER["REMOTE_ADDR"] && time()-$data["date"]<60 )
         {
    	   $idTchat = $data["id"];
    	   }
    	  else if(time()-$data["date"]>60)
        {
    	   $idTchat =  $data["id"];
    	  }
    	  else
        {
    	   $erreur = "Ce pseudo est déja utilisé par quelqu'un d'autre";
    	  }
      }
      if(!isset($erreur))
      {
	    $_SESSION["pseudo"] = $_POST["pseudo"];
	    $_SESSION["idTchat"] = $idTchat;
	    header("location:tchat.php");
      }
}
?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
</head>

<body>
  <div id="conteneur">
    <h1>Mon tchat</h1>
  <?php if(isset($erreur)){ echo "<p>$erreur</p>"; }?>
    <form action="index.php" method="post">
	Pseudo : <input type="text" name="pseudo"/>
	<input type="submit" value="tchatter"/>
    </form>
  </div>
</body>
</html>