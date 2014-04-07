<?php 
	
	if(!empty($_POST)){
		$login      	= $_POST['login'];
		$password   	= $_POST['password'];
		$hashPassword   = hash('sha256',$password.SALT);
		$error = '';

		$prepare 	= $pdo->prepare('SELECT * FROM users WHERE login = :login');
		$prepare 	->bindValue(':login',$login,PDO::PARAM_STR);
		$prepare 	->execute();
		$user 		= $prepare->fetch();

		//No user
		if(empty($user)) {
			$error = 'User not found';
		}
		else {
			//Good pass
			if($user['password'] == $hashPassword) {
				$_SESSION['login'] = $login;
				$_SESSION['id'] = $user['id'];
				header('Location: /');
			} else {
				$error = "Password incorrect";
			}
		}
	}

?>

<div class="container-log">
	<form action="#" method="post">
			<div class="form-group">
				<label for="login">Login</label>
				<input type="text" name="login" id="login">
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input type="password" name="password" id="password">
			</div>
			<?php 

				if(!empty($error)) 
					echo $error;
				else {

				}

			?>
			<div class="form-group">
				<input type="submit" class="btn btn-default">
			</div>
	</form>
</div>