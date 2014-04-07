<?php
    session_start();
	$login = $_SESSION['login'];

	if(isset($login)){
	}
	else{
		header('Location:index.php');
		return false;
	}

	include 'head.php';
?>
<div class="background_chat">
		<div class="container">
				<div class="form-group col-xs-8 col-md-8 col-lg-12">
				    <div class="chat col-lg-offset-2 col-xs-2 col-md-8 col-lg-12"></div>
				</div>
				<form action="#" method="POST">
					<div class="form-group col-lg-offset-2 col-xs-8 col-md-8 col-lg-8">
						<input type="text" class="message form-control" id="message" placeholder="Inscrivez votre message" required autofocus>
						<button type="submit" class="sendMessage btn btn-primary col-xs-12 col-md-12 col-lg-12">Envoyer le message</button>
						<a href="logout.php" class="logout btn btn-danger col-xs-12 col-md-12 col-lg-12">Logout</a>
					</div>
				</form>
			</div>
		</div>
</div>
<script src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/javascript.js"></script>
<?php
include 'footer.php';
?>