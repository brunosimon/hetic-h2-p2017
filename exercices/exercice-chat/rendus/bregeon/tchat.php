    <?php
    session_start ();  
    if (isset($_SESSION['login']) && isset($_SESSION['pass']) && isset($_SESSION['id'])) { 
    ?>

<!doctype html>
<html lang="fr">
<head>
    <title>Tchat // Salon</title>
    <link rel="stylesheet" type="text/css" title="style" href="styles/style.css" />
    <link rel="stylesheet" type="text/css" href="styles/960.css">
    <script type="text/javascript" src="js/jquery-1.4.2.min.js"></script>
    <script type="text/javascript" src="js/actu.js"></script>
</head>

<body>
        <div id="content" class="container_12">

            <header>
                <h1><a href="login.php">HelloTchat</a></h1>
            </header>

        <p><center>Bienvenue <?php echo''.$_SESSION['login'].'' ?></center></p>
        <p><a id="lien" href="logout.php" title="Se déconnecter" >Déconnection</a>
    
    <?php
        $admin = 0;
        try
        {
        	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
            $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
            $req = $bdd->prepare('SELECT pseudo, admin FROM login WHERE pseudo = ?');
            $req->execute(array($_SESSION['login']));

            while ($donnees = $req->fetch())
            {
        		if($donnees['pseudo'] == $_SESSION['login'] && $donnees['admin'] == "1"){
        		$admin = 1;
        		}
        		else{}
        	}
            $req->closeCursor();
        	if ($admin == 1){
        	echo '<a id="lienadmin" href="panneau/controle.php" onclick="window.open(this.href); return false;" title="Espace Admin" >Espace Admin</a>';
        	}
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    ?>
        <a id="salon" href="tchat.php" title="Salon Public" >Salon</a>
        <span id="help">Aide:Taper "@robot aide"</span>
        </p>

        <div id="millieu">
            <div id="chat">
                <div id="tchat">
                </div>
            </div>
            <div id="membre">
                <div id="nombre"></div>
                <div id="connecter"></div>
            </div>

            <textarea onKeydown="if (event.keyCode == 13) envoi();" onKeyup="if (event.keyCode == 13) efface();"  id="message" maxlength="255"></textarea>
            <input id="pseudo" type="text" style="display:none;" value="<?php echo''.$_SESSION['login'].'' ?>"/>
            <input type="submit" id="bouton" onclick="envoi();" value="Envoyer"/> 
        </div>


        <?php
            }  
            else { 
            echo '<body onLoad="alert(\'Erreur\')">'; 
        	$delai=0; 
        	$url='login.php';
        	header("Refresh: $delai;url=$url");
            }  
        ?>
</body>
</html>