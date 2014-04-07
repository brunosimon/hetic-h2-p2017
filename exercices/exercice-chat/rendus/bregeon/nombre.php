<?php
	if(isset($_GET['action']) AND $_GET['action'] == "refresh"){
	$total = "0";
	$homme = "0";
	$femme = "0";
	try
	{
		    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		    $bdd = new PDO('mysql:host=localhost;dbname=tchat', 'root', 'root', $pdo_options);
		    $req2 = $bdd->query('SELECT pseudo, sexe, connecter FROM login');
			while ($donees = $req2->fetch())
		    {		
				if ($donees['connecter'] == "1"){
				if ($donees['sexe'] == "homme"){
				$homme++;
				}
				if ($donees['sexe'] == "femme"){
				$femme++;
				}
				$total++;
				}
				
			}
			$req2->closeCursor();
			echo '<span style="margin:0 0 0 4px;"> <span style="color:red;">'.$total.'</span> utilisateurs en ligne</span> <br /><span id="homme">Homme</span> : '.$homme.' <span id="femme">Femme</span> : '.$femme.'<br /><center>_____________</center><br />';
		}
		catch(Exception $e)
		{
		    die('Erreur : '.$e->getMessage());
		}
	}
?>
