<?php
session_start();
include('phpscripts/functions.php');
$db = db_connect();
?>

<!doctype html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>BOOBACHAT</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div id="container">
	<?php
	if(!empty($_POST['login'])) {
		$login = $_POST['login'];
					
		$query = $db->prepare("SELECT * FROM chat_accounts WHERE account_login = :login");
		$query->execute(array(
			'login' => $login
		));
		$count=$query->rowCount();
					
		if($count == 0) {			
			$insert = $db->prepare('
				INSERT INTO chat_accounts (account_id, account_login, account_pass) 
				VALUES(:id, :login, :pass)
			');
			$insert->execute(array(
				'id' => '',
				'login' => htmlspecialchars($login),
				'pass' => md5($pass)
			));
						
			$_SESSION['id'] = $db->lastInsertId();
			$_SESSION['time'] = time();
			$_SESSION['login'] = $login;
		} else {
			$data = $query->fetch();
						
			if($data['account_pass'] == md5($pass)) {			
				$_SESSION['id'] = $data['account_id'];

				$_SESSION['time'] = time();
				$_SESSION['login'] = $data['account_login'];
			}
		}
		$query->closeCursor();
	}

	if(!user_verified()) { ?>
		<h1>BOOBA</h1><h2>CHAT</h2>
		<div class="unlog">
			<p>Veuillez entrer un pseudo et un mot de passe pour vous inscire </br>ou vous connecter si vous l'êtes déjà. </p>
			<form action="#" method="post">					
				<input type="text" name="login" placeholder="Pseudo"><br>
				<input type="password" name="pass" placeholder="Mot de passe"><br>
				<input type="submit" value="Connexion">
			</form>
		</div>
	<?php } else { ?>
		<h1>BOOBACHAT</h1>
		<div id="content_chat">
			<a href="phpscripts/logout.php" id="exit">Se déconnecter</a>
			<div class="status">
					<span id="statusResponse"></span>
					<select name="status" id="status" style="width:200px;" onchange="setStatus(this)">
						<option value="0">Absent</option>
						<option value="1">Occupé</option>
						<option value="2" selected>En ligne</option>
					</select>
			</div>
			<div class="chat">
			<!-- zone des messages -->
				<div valign="top" id="text-td">
					<div id="text">
						<div id="loading">
							<center>
							<span class="info" id="info">Chargement du chat en cours...</span><br />
							<img src="imgs/ajax-loader.gif" alt="patientez...">
							</center>
						</div>
					</div>
				</div>
				<!-- colonne avec les membres connectés au chat -->
				<div valign="top" id="users-td"><div id="users">Chargement</div></div>
			</div>
			<!-- Zone de texte //////////////////////////////////////////////////////// -->
				
			<a name="post"></a>
			<div class="post_message">
				<form action="" method="" onsubmit="postMessage(); return false;">
					<input type="text" id="message" maxlength="255">
					<input type="submit" value="ENVOYER" id="post">
					<input type="button" value="ENVOYER UNE PUNCHLINE ALÉATOIRE DE BOOBA" id="send-punchline">				
					<input type="hidden" id="dateConnexion" value="<?php echo $_SESSION['time']; ?>">
				</form>
					<div id="responsePost" style="display:none"></div>
			</div>
			</div>
			<div id="punchlines"></div>
		</div>
	<?php } ?>

  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
  <script src="js/chat.js"></script>
</body>
</html>