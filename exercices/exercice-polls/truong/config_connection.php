<?php
	
	error_reporting(E_ALL);      // C'est pour afficher les erreurs
	ini_set('display-errors',1); // C'est pour afficher les erreurs

	define('DB_NAME','exercice-poll-truong');
	define('DB_HOST','localhost');
	define('DB_USER','root');
	define('DB_PASS','root');
	
	echo "RESULTATS";

	//Creation de $datas contenant les differents arrays
	$datas = array(
		"CATHEGORIE" => array( "sucre" , "acidule",),
		"FRUIT" => array("fraise", "pistache", "cerise", "abricot", "banane"),
		"TEXTURE" => array("fondant", "craquant", "petillant", "granuleux")
	);

	// Connexion à la bdd
	try
	{
    	$pdo = new PDO('mysql:dbname='.DB_NAME.';host='.DB_HOST,DB_USER,DB_PASS);
		$pdo->setAttribute(PDO ::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_NAMED);
	}
	catch (PDOException $e)
	{
    	die('error');
	}

	// Si le formulaire n'est pas vide on insere dans la bdd les differents choix
	if(!empty($_POST))
    {
        //if(isset($_POST['cathegorie']) && isset($_POST['cathegorie']))
            $exec = $pdo->exec('INSERT INTO votes (cathegorie, fruit, texture) VALUES (\''.$_POST['cathegorie'].'\', \''.$_POST['fruit'].'\', \''.$_POST['texture'].'\')');
    }

    echo "<table>";

    // On parcours le tableau datas, on recupere aussi key
    foreach ($datas as $key => $value) {
    	echo "<tr>";
    	echo "<td>".$key."</td>";
    	echo "</tr>";

    	// Parcours du tableau Sous Categorie : SC
    	foreach ($value as $keySC => $valueSC) {
    		$query = $pdo->prepare("SELECT count(".$key.") as nbChoix FROM votes WHERE ".$key." = '".$valueSC . "'");
			$query->execute();

			echo "<tr>";
				echo "<td>".$valueSC."</td>";
				echo "<td>".$query->fetch()['nbChoix']."</td>";
			echo "</tr>";
    	}

    	echo "<br>";
    }
    
?>		