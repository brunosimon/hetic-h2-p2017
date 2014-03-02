<?php 

    session_start();
    //$document = basename(__FILE__);
    $titre = "Inscription";

    include("head.php");

    $errors = array();
	$success = array();

	echo '<section class="connect">
	<h1 class="bigger">TP Développement Web</h1>
	<h2 class="fatter">Inscription</h2>';

	function print_form_register($data){
	
		echo '<form action="#" method="POST">
				<input type="text" name="first_name" placeholder="Prénom" value ="'.$data['first_name'].'">
				<input type="email" name="email" placeholder="Email" value ="'.$data['email'].'">
				<input type="password" name="password" placeholder="Mot de passe" value ="'.$data['password'].'">
				<input type="password" name="password_repeat" placeholder="Confirmez" value ="'.$data['password_repeat'].'">
				<input class="btn valid" type="submit" name="form_inscription" value="Inscription" />
			</form>
			<span class="or">ou</span>
			<a class="btn" href="index.php">Connexion</a>
		</section>';
	}

    function clean_data($data){
		$data['password'] = strip_tags(trim($data['password']));
		$data['email'] = strip_tags(trim($data['email']));
		$data['first_name'] = strip_tags(trim($data['first_name']));

		return $data;
	}

	function check_data($data){

		$errors = array();

		if (empty($data['first_name']))
			$errors['first_name'] = 'Erreur : vous devez remplir le champ "Prénom".';

		if (empty($data['password']))
			$errors['password'] = 'Erreur : vous devez remplir le champ "Mot de passe".';
		else if(strlen($data['password']) < 3)
			$errors['password'] = 'Erreur : Votre mot de passe doit au moins contenir 3 caractères.';
		else if(strlen($data['password']) > 30)
			$errors['password'] = 'Erreur : Votre mot de passe ne doit pas contenir plus de 30 caractères.';

		if ($data['password'] != $data['password_repeat'])
			$errors['password'] = 'Erreur : les deux mots de passe ne sont pas identiques.';

		if (empty($data['email']))
			$errors['email'] = 'Erreur : vous devez remplir le champ "E-Mail".';
		else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			$errors['email'] = 'Erreur : votre adresse e-mail n\'est pas valide.';

		return $errors;

	}

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){
    	header('Location:membre.php');
	}
	else{

		if (!empty($_POST['form_inscription'])){

			$data = clean_data($_POST);
			$errors = check_data($data);

			require_once 'config.inc.php';

			$req = $pdo->prepare('SELECT * FROM users WHERE email = ?');
		    $req->execute(array($data['email']));
		    $nb_rows = $req->rowCount();

	    	if ($nb_rows > 0) $errors['email_used'] = 'Erreur : l\'e-mail déjà utilisé.';

			if (empty($errors)){	
					  
	    		$password = sha1($data['password']);
	    		$first_name = $data['first_name'];
	    		$email = $data['email'];

	    		$req = 'INSERT INTO users (password,first_name,email) VALUES (:password, :first_name, :email)';
				$insert = $pdo->prepare($req);
				$insert->execute(array('password' => $password, 'first_name' => $first_name, 'email' => $email));

				echo '<article class="success">
					Inscription réussie ! <br />
					Cliquez <a href="index.php">ici</a> pour vous connecter.
					</article>';
			}
			else{
				//Afficher erreurs
				echo '<article class="errors">';

				foreach ($errors as $_errors){
					echo '<p class="error">'.$_errors.'</p>';
				}
				echo '</article>';
				print_form_register($data);
			}

		}
		else{

			$data = array(
				'password' => '',
				'password_repeat' => '',
				'first_name' => '',
				'email' => ''
			);

				print_form_register($data);
			}
	}

    include("footer.php"); 

?>