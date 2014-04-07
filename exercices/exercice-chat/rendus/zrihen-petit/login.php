<?php
	session_start();
include 'head.php';
	
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>LOGIN</title>
</head>
	<body>
	   	<div class="background">
			<div class="container">
				<div class="login">
				    <div class="col-lg-offset-4 col-xs-10 col-md-8 col-lg-5">
					<h1>Connectez-vous</h1>
				    </div>
					<form action="verif.php" method="POST">
						<div class="form-group col-lg-offset-3 col-xs-8 col-md-8 col-lg-6">
								<input type="text" class="form-control" name="login" id="login" placeholder="Login" >
						</div>
						<div class="form-group col-lg-offset-3 col-xs-8 col-md-8 col-lg-6">
							<input type="password" class="form-control" name="password" id="password" placeholder="Mot de Passe" >
							<input type="submit" class="sendMessage btn btn-primary col-xs-12 col-md-6 col-lg-12">
						</div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>
<?php
include 'footer.php';
?>