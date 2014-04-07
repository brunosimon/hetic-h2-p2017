<?php
	include('config.php');
	
	$session = new Session($base->pdo);
	$account = new Account($base->pdo);
	
	$session->activity(0);
	
	if(isset($_COOKIE["user_id"]) && $_COOKIE["user_token"] && $account->checkToken()){
		$session->reset($_COOKIE["user_id"]);
	}
	else{
		$account->create('anonymous', '');
	}
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>ChatBox - Conversez à travers le monde</title>
		<meta charset="UTF-8">

		<meta name="viewport" content="width=device-width, user-scalable=no">
		
		<link rel="shortcut icon" type="image/ico" href="favicon.ico" />
		
		<link href="./css/main.css" rel="stylesheet" type="text/css">

	</head>
	
	<body>
		<div class="clearfix welcome">
			<section class="connect">
				<h2>Bienvenue sur ChatBox</h2>
				<div class="messageBox">
					<noscript><span class="message">Attention : ChatBox ne marchera pas sans javascript</span></noscript>
				</div>
				<form action="#" method="post">
					<input class="input-text" type="text" name="login" placeholder="Pseudo (Obligatoire)" value="<?php if (isset($account->login)) echo $account->login; ?>" maxlength="40" required>
					<input class="input-text" type="text" name="message" placeholder="Message de présentation" value="<?php if (isset($account->login)) echo $account->message; ?>" maxlength="140">
					
					<div class="checkboxes clearfix">
						<span class="labelcheckbox"><label for="geolocationswitch">Géolocalisation</label></span>
						
						<div class="onoffswitch">
							<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="geolocationswitch">
							<label class="onoffswitch-label" for="geolocationswitch">
								<span class="onoffswitch-inner"></span>
								<span class="onoffswitch-switch"></span>
							</label>
						</div>
					</div>
					
					<input type="hidden" name="lat">
					<input type="hidden" name="long">
					
					<input type="hidden" name="user_id" value="<?php echo $_COOKIE["user_id"]; ?>">
					
					<div class="checkboxes clearfix webcamdetection">
						<span class="labelcheckbox"><label for="videoswitch">Webcam</label></span>
						
						<div class="onoffswitch">
							<input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="videoswitch">
							<label class="onoffswitch-label" for="videoswitch">
								<span class="onoffswitch-inner"></span>
								<span class="onoffswitch-switch"></span>
							</label>
						</div>
					</div>

					<video autoplay></video>
					
					<input type="submit" class="button" value="Chatter">
				</form>
			</section>
			
			<section class="wait">
				<span>Connexion en cours</span>
			</section>
		</div>
		
		<div class="clearfix chatbox">
			<div class="box clearfix">
				<h2>En chat avec <span class="peer-login"></span></h2>
				<h3><span class="peer-message"></span> <span class="peer-distance"></span></h3>
				
				<div class="clearfix webcams hide webcamdetection">
					<div class="chat left-col">
						<video class="video_peer" autoplay></video>
					</div>
					
					<div class="chat right-col">
						<video class="video_me" autoplay></video>
					</div>
				</div>
				
				<div class="chat">
					<div class="messages no-video">
						
					</div>
					
					<div class="inputchat">
						<form action="#">
							<input type="text">
							<input type="submit" class="button" value="Envoyer">
						</form>
					</div>
					
					<input type="submit" class="button clicknext" value="Suivant">
				</div>
			</div>
		</div>
		
		<script type="text/javascript" src="./js/jquery.min.js"></script>
		<script type="text/javascript" src="./js/ui.js"></script>
		<script type="text/javascript" src="./js/peer.min.js"></script>
	</body>
</html>