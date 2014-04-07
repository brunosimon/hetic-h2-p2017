<?php
    session_start ();  
    if (isset($_SESSION['login']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) { 
?>
<?php
	if(isset($_GET['action']) AND isset($_GET['message']) AND isset($_GET['pseudo']) AND $_GET['action'] == "envoi" AND $_GET['message'] != ""){
	if (strlen($_GET['message']) < 256){
	$message = $_GET['message'];
	$message = strip_tags($message);
	$normal = 0;
	$mp = "";
	$reception = "";
	$personne = "";
	$regexmp = '#^@#';
	$regexrobot = '#^@robot#';
	$regexpm = '#^mp@#';
	$regexbloc = '#^block@#';
	$unefois = 0;
	if (preg_match($regexmp, $message)) {
	if (preg_match($regexrobot, $message)) {
	$normal = 2;
	}
	else{
	$normal = 1;
	}
	}
	elseif (preg_match($regexpm, $message)) {
	$normal = 3;
	}
	elseif (preg_match($regexbloc, $message)) {
	$normal = 4;
	}
	if ($normal == 1){
	try
	{	
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', '', $pdo_options2);
	    $req = $bdd2->query('SELECT pseudo, sexe, admin, connecter FROM login');

	    while ($donnees = $req->fetch())
	    {
			if ($unefois == 0){
			$mp = '@'.$donnees['pseudo'].'';
			$pos = strpos($message, $mp);
			if ($pos === false) {
			} else {
				$personne = $donnees['pseudo'];
				$reception = $mp;
				$reception = str_replace('@','',$reception);
				$unefois = 1;
				}
				}
		}
	    $req->closeCursor();

		}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if ($_GET['pseudo'] != $personne){
	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO message (pseudo, message, priver, recepteur) VALUES(:envoi, :message, :priver, :recept)');
	$req2->execute(array(
		'envoi' => $_GET['pseudo'],
		'message' => $message,
		'priver' => "1",
		'recept' => $reception
		));
	$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	}
	elseif ($normal == 4){
	try
	{	
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->prepare('SELECT id, pseudo, blockmp FROM login WHERE pseudo = ?');
	$req->execute(array(
		$_GET['pseudo']
		));
	    while ($donnees = $req->fetch())
	    {
			if($donnees['pseudo'] == $_GET['pseudo']){
			$upmp = $donnees['blockmp'];
			$upid = $donnees['id'];
			}
		}
	    $req->closeCursor();

		}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if($upmp == "0"){
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET blockmp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "1",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET mp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	else{
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET blockmp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET mp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	}
	elseif ($normal == 3){
	$upmp = 1;
	try
	{	
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->prepare('SELECT id, pseudo, mp FROM login WHERE pseudo = ?');
	$req->execute(array(
		$_GET['pseudo']
		));
	    while ($donnees = $req->fetch())
	    {
			if($donnees['pseudo'] == $_GET['pseudo']){
			$upmp = $donnees['mp'];
			$upid = $donnees['id'];
			}
		}
	    $req->closeCursor();

		}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if($upmp == "0"){
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET mp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "1",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET blockmp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	else{
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', '', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET mp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET blockmp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $upid
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	}
	elseif ($normal == 2){
	try
	{	
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->query('SELECT pseudo, sexe, admin, connecter FROM login');

	    while ($donnees = $req->fetch())
	    {
			if ($unefois == 0){
			$mp = '@robot';
			$pos = strpos($message, $mp);
			if ($pos === false) {
			} else {
				$personne = $donnees['pseudo'];
				$reception = $mp;
				$reception = str_replace('@','',$reception);
				$unefois = 1;
				}
				}
		}
	    $req->closeCursor();

		}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if ($_GET['pseudo'] != $personne){
	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO message (pseudo, message, priver, recepteur) VALUES(:envoi, :message, :priver, :recept)');
	$req2->execute(array(
		'envoi' => $_GET['pseudo'],
		'message' => $message,
		'priver' => "1",
		'recept' => $reception
		));
	$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	$robot = "";
			$pos = strpos($message, "@robot aide");
			if ($pos === false) {
	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO message (pseudo, message, priver, recepteur) VALUES(:envoi, :message, :priver, :recept)');
	$req2->execute(array(
		'envoi' => 'robot',
		'message' => '@'.$_GET['pseudo'].' Désolé, je ne peut répondre car je suis un Robot.<br />Vous pouvez me demander de l\'aide en disant:<br />@robot aide<br />Pour tout autre question contacter un Admin.',
		'priver' => "1",
		'recept' => $_GET['pseudo']
		));
	$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
			} else {
	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO message (pseudo, message, priver, recepteur) VALUES(:envoi, :message, :priver, :recept)');
	$req2->execute(array(
		'envoi' => 'robot',
		'message' => '@'.$_GET['pseudo'].' Vous avez demander de l\'aide. Taper:<br /> <span style="color:red;">$[pseudo]</span> pour citer une personne<br /><span style="color:red;">@[pseudo]</span> pour lui envoyer un MP<br /><span style="color:red;">*mp*</span> Pour afficher que les MP (retapé le pour de nouveau tous afficher)<br /><span style="color:red;">*block*</span> Pour bloquer les mp(retaper pour débloquer).',
		'priver' => "1",
		'recept' => $_GET['pseudo']
		));
	$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
				}
			$pos = strpos($message, "@robot quelle heure il est?");
			if ($pos === false) {
			} else {
			$date = date("H:i:s");
	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO message (pseudo, message, priver, recepteur) VALUES(:envoi, :message, :priver, :recept)');
	$req2->execute(array(
		'envoi' => 'robot',
		'message' => '@'.$_GET['pseudo'].' Il est '.$date.'',
		'priver' => "1",
		'recept' => $_GET['pseudo']
		));
	$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
				}

	}
	}
	else{
	$fh = 0;
	$hash = "";
	try
	{	
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->query('SELECT pseudo, sexe, admin, connecter FROM login');

	    while ($donnees = $req->fetch())
	    {
			$hash = '$'.$donnees['pseudo'].'';
			$pos = strpos($message, $hash);
			if ($pos === false) {
			} else {
			if($donnees['connecter'] == "1"){
			if($donnees['sexe'] == "homme"){
			$fh = 1;
			}
			if($donnees['sexe'] == "femme"){
			$fh = 2;
			}
			if($donnees['admin'] >= "1"){
			if($donnees['admin'] == "1"){
			$fh = 3;
			}
			else{
			$fh = 4;
			}
			}
			if ($fh == 1){
			$message = str_replace($hash,'<span id="homme">'.$donnees['pseudo']. '</span>',$message);
			}
			if ($fh == 2){
			$message = str_replace($hash,'<span id="femme">'.$donnees['pseudo'].' </span>',$message);
			}
			if ($fh == 3){
			$message = str_replace($hash,'<span id="admin">'.$donnees['pseudo']. '</span>',$message);
			}
			if ($fh == 4){
			$message = str_replace($hash,'<span id="robot">'.$donnees['pseudo']. '</span>',$message);
			}
			}
			else{
			$message = str_replace($hash,''.$donnees['pseudo']. '',$message);
			}
				}
		}
	    $req->closeCursor();

		}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}

	try
	{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		$req2 = $bdd->prepare('INSERT INTO message (pseudo, message) VALUES(:pseudo, :message)');
	$req2->execute(array(
		'pseudo' => $_GET['pseudo'],
		'message' => $message
		));
	$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	}
	}
	elseif(isset($_GET['action']) AND $_GET['action'] == "refresh"){
	$login = "";
	$hf = "0";
	try
	{	
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->prepare('SELECT pseudo, mp, blockmp FROM login WHERE pseudo = ?');
	$req->execute(array(
		$_SESSION['login']
		));
	    while ($donnees = $req->fetch())
	    {
			if($donnees['pseudo'] == $_SESSION['login']){
			$onlymp = $donnees['mp'];
			$bloc = $donnees['blockmp'];
			}
		}
	    $req->closeCursor();

		}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	if($bloc == "1" && $onlymp == "0"){
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);				   
	$req3 = $bdd->prepare('UPDATE login SET mp = :up WHERE id = :login');
	$req3->execute(array(
		'up' => "0",
		'login' => $_SESSION['login']
		));
	$req3->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT pseudo, message, priver, recepteur FROM message');
		while ($donees = $req2->fetch())
	    {	
		if($donees['priver'] == "0"){
		$login = $donees['pseudo'];
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->prepare('SELECT pseudo, sexe, admin FROM login WHERE pseudo = ?');
	    $req->execute(array($login));

	    while ($donnees = $req->fetch())
	    {
			if($donnees['sexe'] == "homme"){
			$hf = 1;
			}
			if($donnees['sexe'] == "femme"){
			$hf = 2;
			}
			if($donnees['admin'] >= "1"){
			if($donnees['admin'] == "1"){
			$hf = 3;
			}
			else{
			$hf = 4;
			}
			}
		}
	    $req->closeCursor();
			if ($hf == 1){
			echo'<b><span id="homme">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span><br /><br />';
			}
			if ($hf == 2){
			echo'<b><span id="femme">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span><br /><br />';
			}
			if ($hf == 3){
			echo'<b><span id="admin">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span><br /><br />';
			}
			if ($hf == 4){
			echo'<b><span id="robot">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span><br /><br />';
			}
		}
		else{

		}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	elseif($onlymp == "1" && $bloc == "0"){
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT pseudo, message, priver, recepteur FROM message');
		while ($donees = $req2->fetch())
	    {	
		if($donees['priver'] == "0"){
		$login = $donees['pseudo'];
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->prepare('SELECT pseudo, sexe, admin FROM login WHERE pseudo = ?');
	    $req->execute(array($login));

	    while ($donnees = $req->fetch())
	    {
			if($donnees['sexe'] == "homme"){
			$hf = 1;
			}
			if($donnees['sexe'] == "femme"){
			$hf = 2;
			}
			if($donnees['admin'] >= "1"){
			if($donnees['admin'] == "1"){
			$hf = 3;
			}
			else{
			$hf = 4;
			}
			}
		}
	    $req->closeCursor();

		}
		else{
		$regexmp = '#^@#';
		if($donees['pseudo'] == $_SESSION['login'] || $donees['recepteur'] == $_SESSION['login']){
		if($donees['pseudo'] == $_SESSION['login']){
		$moi = 1;
		}
		if($donees['recepteur'] == $_SESSION['login']){
		$moi = 2;
		}
		$login = $donees['pseudo'];
		$pdo_options3[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd3 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options3);
	    $req3 = $bdd3->prepare('SELECT pseudo, sexe, admin FROM login WHERE pseudo = ?');
	    $req3->execute(array($login));

	    while ($donnes = $req3->fetch())
	    {
			if($donnes['sexe'] == "homme"){
			$hf = 1;
			}
			if($donnes['sexe'] == "femme"){
			$hf = 2;
			}
			if($donnes['admin'] >= "1"){
			if($donnes['admin'] == "1"){
			$hf = 3;
			}
			else{
			$hf = 4;
			}
			}
		}
	    $req3->closeCursor();
		if ($moi == 1){
			if ($hf == 1){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="homme">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 2){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="femme">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 3){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="admin">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 4){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="robot">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
		}
		if ($moi == 2){
			if ($hf == 1){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="homme">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 2){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="femme">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP  : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 3){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="admin">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP  : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 4){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="robot">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP  : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
		}	
		}
		}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}
	else{
	try
	{
	    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
	    $req2 = $bdd->query('SELECT pseudo, message, priver, recepteur FROM message');
		while ($donees = $req2->fetch())
	    {	
		if($donees['priver'] == "0"){
		$login = $donees['pseudo'];
		$pdo_options2[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd2 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options2);
	    $req = $bdd2->prepare('SELECT pseudo, sexe, admin FROM login WHERE pseudo = ?');
	    $req->execute(array($login));

	    while ($donnees = $req->fetch())
	    {
			if($donnees['sexe'] == "homme"){
			$hf = 1;
			}
			if($donnees['sexe'] == "femme"){
			$hf = 2;
			}
			if($donnees['admin'] >= "1"){
			if($donnees['admin'] == "1"){
			$hf = 3;
			}
			else{
			$hf = 4;
			}
			}
		}
	    $req->closeCursor();
			if ($hf == 1){
			echo'<b><span id="homme">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 2){
			echo'<b><span id="femme">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 3){
			echo'<b><span id="admin">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 4){
			echo'<b><span id="robot">'.$donees['pseudo'].'</span></b> a dit : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
		}
		else{
		$regexmp = '#^@#';
		if($donees['pseudo'] == $_SESSION['login'] || $donees['recepteur'] == $_SESSION['login']){
		if($donees['pseudo'] == $_SESSION['login']){
		$moi = 1;
		}
		if($donees['recepteur'] == $_SESSION['login']){
		$moi = 2;
		}
		$login = $donees['pseudo'];
		$pdo_options3[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    $bdd3 = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options3);
	    $req3 = $bdd3->prepare('SELECT pseudo, sexe, admin FROM login WHERE pseudo = ?');
	    $req3->execute(array($login));

	    while ($donnes = $req3->fetch())
	    {
			if($donnes['sexe'] == "homme"){
			$hf = 1;
			}
			if($donnes['sexe'] == "femme"){
			$hf = 2;
			}
			if($donnes['admin'] >= "1"){
			if($donnes['admin'] == "1"){
			$hf = 3;
			}
			else{
			$hf = 4;
			}
			}
		}
	    $req3->closeCursor();
		if ($moi == 1){
			if ($hf == 1){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="homme">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 2){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="femme">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 3){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="admin">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 4){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="robot">'.$donees['pseudo'].'</span></b> <span id="messagepriver">a dit (@'.$donees['recepteur'].'): <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
		}
		if ($moi == 2){
			if ($hf == 1){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="homme">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 2){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="femme">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP  : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 3){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="admin">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP  : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
			if ($hf == 4){
			$donees['message'] = str_replace('@'.$donees['recepteur'].'','',$donees['message']);
			echo'<b><span id="robot">'.$donees['pseudo'].'</span></b> <span id="messagepriver2">a dit en MP  : <br /><span id="contenu">'.$donees['message'].'</span></span><br /><br />';
			}
		}	
		}
		}
		}
		$req2->closeCursor();
	}
	catch(Exception $e)
	{
	    die('Erreur : '.$e->getMessage());
	}
	}

	}
?>
<?php
    }  
    else { 

       echo '<body onLoad="alert(\'Erreur\')">'; 
	   $delai=0; 
	$url='login.php';
	header("Refresh: $delai;url=$url");

    }  
?>