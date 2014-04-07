<?php	
	if(!empty($_POST)) {
		$login = $_POST['login'];
		$password_1 = $_POST['password1'];
		$password_2 = $_POST['password2'];
		$error = '';
		$writable = true;

		$prepare = $pdo->prepare('SELECT * FROM users');
		$prepare -> execute();
		$users = $prepare->fetchAll();

		foreach ($users as $key => $value) {
			if($value['login']==$login) {
				$writable = false;
				$error = "Login already exists";
			}
		}

		//Unique login
		if($writable == true) {
			//Same password
			if($password_1 == $password_2) {
				$prepare = $pdo->prepare('INSERT INTO users (login,password,name) VALUES (:login,:password,:login)');
				$prepare->bindValue(':login',$login,PDO::PARAM_STR);
				$prepare->bindValue(':password',hash('sha256',$password_1.SALT),PDO::PARAM_STR);
				$prepare->execute();

				//User saved
				if($prepare)
					echo 'User saved';
					header('Location: /');
			}

			//Different passwords
			else {
				$error = 'Passwords doesn\'t match';
			}
		}
	}
?>

<div class="container container-log">
	<form action="#" method="POST">
		<div class="form-group">
			<label for="login">Login</label>
			<input type="text" name="login" id="login">
		</div>
		<div class="form-group">
			<label for="password1">Password</label>
			<input type="password" name="password1" id="password-1">
		</div>
		<div class="form-group">
			<label for="password2">Password confirme</label>
			<input type="password" name="password2" id="password-2">
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