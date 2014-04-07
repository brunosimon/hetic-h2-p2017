<?php
	if(!isset($_SESSION['login'])){
		echo '<meta http-equiv="refresh" content="0; URL=index.php?page=accueil">';
		die();
	}
	
?>
<div class="chat">
	<div class="container_chat">
		<div class="messages"></div>

		<div class="send_form">
			<form action="#" method="POST" id="sender_message">
				<input class="input_msg" type="text" placeholder="Votre message" name="message">
				<input class="input_send" type="submit" value="Envoyer !">
			</form>
		</div>
	</div>
</div>