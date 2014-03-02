<?php 

    session_start();
    //$document = basename(__FILE__);
    $titre = "Accueil";

    include("head.php");

    echo '<section class="connect">
			<h1 class="bigger">Probe System</h1>
			<h2 class="fatter">Connexion</h2>';

    function print_form_connect(){
			
		echo '<form action="#" method="POST">
				<input type="email" name="email" placeholder="Email">
				<input type="password" name="password" placeholder="Mot de passe">
				<input class="btn" type="submit" name="form_connection" value="Connexion" />
			</form>
			<span class="or">ou</span>
			<a class="btn valid" href="inscription.php">Inscription</a>
		</section>';
    }

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){
    	header('Location:membre.php');
	}
	else{
		if (!empty($_POST['form_connection'])){
			if ((!empty($_POST['email'])) && (!empty($_POST['password']))) {

				require_once 'config.inc.php';	  
			    $req = $pdo->prepare('SELECT * FROM users WHERE email = ? AND password = ?');
			    $req->execute(array($_POST['email'], sha1($_POST['password'])));
			    $nb_rows = $req->rowCount();

				    if ($nb_rows > 0){
				    	$data = $req->fetch(); 
				    	$_SESSION['id'] = $data['id'];
				    	$_SESSION['email'] = $data['email'];
				    	$_SESSION['first_name'] = $data['first_name'];
				    	$_SESSION['auth'] = true;


						header('Location:membre.php');
				    }
				    else{
				    	echo '<article class="errors">Impossible de se connecter : informations incorrectes.</article>';
				    	print_form_connect();
				    }
			}
			else{
				echo '<article class="errors">Erreur : Tous les champs n\'ont pas été remplis.</article>';
				print_form_connect();
			}

		}
		else{
			print_form_connect();
		}

	}

    include("footer.php"); 

?>