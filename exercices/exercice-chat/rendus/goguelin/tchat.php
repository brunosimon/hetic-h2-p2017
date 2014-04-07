<?php

	mysql_select_db( "exercice-chat-goguelin" ) or die( 'Error'. mysql_error() );

	//On démarre la session de l'utilisateur
	session_start();
	// On vérifie que l'utilisateur a bien un pseudo sinon on le redirige vers l'index
	if(!isset($_SESSION["pseudo"]) || empty($_SESSION["pseudo"]))
	{
		header("location:index.php");
	}

	include "connect.php";
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
	<meta charset="UTF-8">
  	<script type="text/javascript" src="js/jquery.js"></script>
  	<script type="text/javascript" src="js/tchat.js"></script>
  	<script type="text/javascript">
		<?php
			$sql = "SELECT id FROM messages ORDER BY id DESC LIMIT 1";
			$req = mysql_query($sql) or die(mysql_error());
			$data = mysql_fetch_assoc($req);
		?>
		var lastid = <?php echo $data["id"]; ?>
  	</script>
</head>

<body>
<!-- On récupère le pseudo de l'utilisateur et on l'affiche -->
  <div id="conteneur" style="width:94%; margin-bottom:200px;">
    <h1>Mon tchat, connectez en tant que <?php echo $_SESSION["pseudo"]; ?></h1>
    <div id="connected">
	</div>
    <div id="tchat">
	 <?php
		$sql = "SELECT * FROM messages ORDER BY date DESC LIMIT 15";
		$req = mysql_query($sql) or die(mysql_error());
		$d = array();
		while($data = mysql_fetch_assoc($req)){
			$d[] = $data;
		}
		for($i=count($d)-1;$i>=0;$i--){			
		?>
			<p><strong><?php echo $d[$i]["pseudo"]; ?></strong> (<?php echo date("d/m/Y H:i:s",$d[$i]["date"]); ?>) : <?php echo htmlentities(utf8_decode($d[$i]["message"])); ?></p>
		<?php
		}
	 ?>
    </div>
  </div>
  
  <div id="tchatForm" style="position:fixed;bottom:0;width:100%;">
       <form method="post" action="#">
	  <div style="margin-right:110px;">
	      <textarea name="message" style="width:100%;"></textarea>
	  </div>
	  <div style="position:absolute; top:12px; right:0;">
	      <input type="submit" value="Envoyer"/>
	  </div>
	</form>      
  </div>
</body>
</html>