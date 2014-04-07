<?php 
	require 'config.php';	
	include('function.php');


	// if(!isset($_SESSION['nickname']) || empty($_SESSION['nickname'])){
	// 	header('location:../../index.php');
	// }

	

	

?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Chat - Deloizy Ruiz</title>
	<link rel="stylesheet" href="../css/style.css">
</head>
<body>
	
	<p class="welcome">Welcome <?php echo $_SESSION['nickname']; ?></p>

	<div id="messages"></div>

	<div id="chatForm">
		<form action="#" id="send_message">

			<img class="rounded_chat" <?php if (isset($_SESSION['id']) && $_SESSION['id']): ?> src="../images/photos_uploaded/<?php echo $_SESSION['id'];?>.jpg" <?php endif ?>>
			<textarea name="message" class="the-message" placeholder="Write a message" required></textarea>	
			<div class="emots">
				<img src="../images/smileys/smile.png" class="button_smiley" smiley=':)'><br/>
				<img src="../images/smileys/laugh.png" class="button_smiley" smiley=':D'><br/>
				<img src="../images/smileys/eye.png" class="button_smiley" smiley=';)'><br/>
				<img src="../images/smileys/tong.png" class="button_smiley" smiley=':P'><br/>
				<img src="../images/smileys/kiss.png" class="button_smiley" smiley=':*'><br/>
				<img src="../images/smileys/bad.png" class="button_smiley" smiley=':('><br/>
				<img src="../images/smileys/afraid.png" class="button_smiley" smiley=':O'><br/>
				<img src="../images/smileys/cry.png" class="button_smiley" smiley=':(('><br/>
				<img src="../images/smileys/heart.png" class="button_smiley" smiley='<3'>
			</div>

			<div class="send"></div>
			<input type="submit" value="Send" class="button_send">	
		</form>
	</div>


	<a href="../../index.php" class="back">
Home</a>
	

	<script src="http://code.jquery.com/jquery-2.1.0.min.js"></script>
	<script src="../js/script.js"></script>
</body>
</html>