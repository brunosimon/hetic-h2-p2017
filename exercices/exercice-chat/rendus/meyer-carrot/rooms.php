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
	<title>Rooms</title>
</head>
<body id="room-page">

	<a href="index.php">
    	<div id="logout">
        	<p>LOG OUT</p>
    	</div>
	</a>

	<div id="sucess">
		<p>	
			<?php 
			if(isset($_GET['pseudo'])){

				if(isset($_POST['room_name'])){
					$req = $pdo->prepare("INSERT INTO rooms VALUES (NULL, :creator, :name, NOW())");
			    	$req->bindParam(':creator',$_GET['pseudo']);
			    	$req->bindParam(':name',$_POST['room_name']);
			    	$res = $req->execute();

			    	if($res>=1){
			    	echo "ROOM CREATED !";
			    	}
				}
			?>
		</p>
	</div>

	<div id="action-room">
		<div id="creating">
			<h2>CREATE YOUR ROOM</h2>
				<form action="rooms.php?pseudo=<?= $_GET['pseudo']; ?>" method="POST">
					<input id="creating-name" type="text" name="room_name" placeholder="Name of the room">
					</br>
					<input id="creating-button" type="submit" value="Create">
				</form>
		</div>
		<div id="joining">
			<h2>JOIN A ROOM</h2>
			<?php
				$req = $pdo->prepare("SELECT * FROM rooms ORDER BY name");
				$req->execute();

				$res = $req->fetchAll();

					foreach($res as $data){
				    	echo "	<div id='room-container'>
				    					<a href='chat.php?room=".$data['id']."&pseudo=".$_GET['pseudo']."'>".$data['name']."</a>
				    					</br> created by <span id='creator'>".$data['creator']."</span>
				    					<span id='creation-date'>".$data['date']."</span>
								</div>
				    			<br/>";
					}	
				}
			?>
		</div>
	</div>
</body>
</html>