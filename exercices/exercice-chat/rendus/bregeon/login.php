<!doctype html>
<html lang="fr">
<head>
	<title>Tchat // Acceuil</title>
	<link rel="stylesheet" type="text/css" title="style" href="styles/style.css" />
	<link rel="stylesheet" type="text/css" href="styles/960.css">
</head>

<body>
	    <div id="content" class="container_12">

	    	<header>
				<h1><a href="login.php">HelloTchat</a></h1>
			</header>

	        <div id="home">
				<div id="box" class="grid_3">
				        <fieldset>
				        	<legend>Inscription</legend>
				            <form action="login.php" method="post" id="inscription" name="inscription">
				                <div><input type="text" id="pseudo" name="pseudo" maxlength="20" placeholder="Your pseudo"/></div>
				                <div><input type="password" id="mdp" name="mdp" maxlength="20" placeholder="Your password" /></div>
				                <div><select id="sexe" name="sexe">
				                        <option value="0">Sexe</option>
				                        <option value="homme" >Homme</option>
				                        <option value="femme" >Femme</option>
				                </select></div>
				            </br>
				                <div><input type="submit" value="S'inscrire"/></div>
				            </form>
				        </fieldset>


				</div>

				<div id="box" class="grid_3">
						<fieldset>
							<legend>Connection</legend>
							<form action="" method="post" id="connection">
								<div><input type="text" id="login" name="login" maxlength="20" value="" placeholder="Login"/></div>
								<div><input type="password" id="pass" name="pass" maxlength="20" value="" placeholder="Mot de passe"/></div>
								</br></br>
								<div><input type="submit" value="Connection"/></div>
							</form>
					</fieldset>
				</div>
			</div>
		<a href="tchat.php">Accès au Tchat</a>
	    </div>

<?php
	$utiliser = 0;
	$regexnom = '/^([a-zA-Z\'àâéèêôùûçÀÂÉÈÔÙÛÇ-]{1,20})$/';
	if(isset($_POST['pseudo']) && isset($_POST['mdp']) && isset($_POST['sexe'])){
		if($_POST['pseudo'] != "" && $_POST['mdp'] != "" && $_POST['sexe'] != "0"){
			if (preg_match($regexnom, $_POST['pseudo'])) {
				if ($_POST['sexe'] == "homme" || $_POST['sexe'] == "femme"){
					if (strlen($_POST['pseudo']) < 21 && strlen($_POST['mdp']) < 21){
	try{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT pseudo FROM login');
		while ($donees = $req2->fetch()){		
			if ($donees['pseudo'] == $_POST['pseudo']){
				$utiliser = 1;
			}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if ($utiliser == 0){
		$ip = "";
	function detectip()
	{
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip =$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	elseif(isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	$ip = detectip();
	$bani = 0;
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT ip, bani FROM login');
		while ($donees = $req2->fetch())
	    {		
			if ($donees['ip'] == $ip && $donees['bani'] == "1"){
				$bani = 1;
			}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if ($bani == 0){
	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO login (pseudo, mdp, sexe, ip) VALUES(:pseudo, :mdp, :sexe, :ip)');
	$req2->execute(array(
		'pseudo' => $_POST['pseudo'],
		'mdp' => $_POST['mdp'],
		'sexe' => $_POST['sexe'],
		'ip' => $ip
		));
	$req2->closeCursor();
	$_POST['pseudo'] = "";
	$_POST['mdp'] = "";
	$_POST['sexe'] = "0";

	       echo '<body onLoad="alert(\'Enregistré\')">'; 
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}}
	else{
	echo '<body onLoad="alert(\'Vous avez été bani :: pour plus de détail contacter l admin\')">';
	}}}
	}
	}
	}
	}
	$utilisateur = 0;
	$id = "";
	if(isset($_POST['login']) && isset($_POST['pass'])){
	if($_POST['login'] != "" && $_POST['pass'] != ""){
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT id, pseudo, mdp FROM login');
		while ($donees = $req2->fetch())
	    {		
			if ($donees['pseudo'] == $_POST['login'] && $donees['mdp'] == $_POST['pass']){
				$id = $donees['id'];
				$utilisateur = 1;
			}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
		$ip = "";
	function detectip()
	{
	if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
		{
			$ip =$_SERVER['HTTP_X_FORWARDED_FOR'];
		}
	elseif(isset($_SERVER['HTTP_CLIENT_IP']))
		{
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		}
	else
		{
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return $ip;
	}
	$ip = detectip();
	$ban = 0;
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT pseudo, ip, bani FROM login');
		while ($donees = $req2->fetch())
	    {		
			if ($donees['ip'] == $ip && $donees['bani'] == "1"){
				$ban = 1;
			}
			if ($donees['pseudo'] == $_POST['login'] && $donees['bani'] == "1"){
				$ban = 1;
			}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if($ban == 0){
	if($utilisateur == 1){
		 				   session_start (); 
	                   $_SESSION['login'] = $_POST['login']; 
					   $_SESSION['pass'] = $_POST['pass'];
					   $_SESSION['id'] = $id;

	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET connecter = :up, ip = :ip WHERE id = :login');
	$req3->execute(array(
		'up' => "1",
		'login' => $id,
		'ip' => $ip
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}				   
	$_POST['login'] = "";
	$_POST['pass'] = "";
	       echo '<body onLoad="alert(\'Bienvenue\')">'; 
		$delai=0; 
		$url='tchat.php';
		header("Refresh: $delai;url=$url");
	}
	else{
	$_POST['login'] = "";
	$_POST['pass'] = "";
	echo '<body onLoad="alert(\'Membre non reconue\')">'; 
	}
	}
	else{
	$_POST['login'] = "";
	$_POST['pass'] = "";
	echo '<body onLoad="alert(\'Vous avez été bani :: pour plus de détail contacter l admin\')">';
	}
	}
	}
	else{

	}
?>

</body>

</html>