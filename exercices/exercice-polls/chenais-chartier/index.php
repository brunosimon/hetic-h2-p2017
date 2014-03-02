<?php require 'config.php';
	
	//Dans ce tableau on va associer chaque élément à une valeur précise dans la base de donnée, clé => valeur
	$values = array(

		'leportrait' => 'Le Portrait',
		'maya' => 'Maya',
		'clearout' => 'Clear Out',
		'twilight' => 'Twilight',
		'meninblack' => 'Men In Black',
		'sharknado' => 'Sharknado',
		'nationaltreasure' => 'National Treasure',
		'hungergames' => 'Hunger Games'
		);

	//COOKIE PART
	if ((!empty($_POST['name']))&&(!isset($_COOKIE['token']))) {
		setcookie('token','1',time() + 60*6,'/');
		//Cette ligne va rentrer dans la base de données le film voté par l'user
		$exec = $pdo->exec('INSERT INTO votes (name) VAlUES (\''.$_POST['name'].'\')');
		//On rafraichi la page ici pour permettre au cookie de s'initialiser
		header('Location: index.php');
	}

	//
	$query = $pdo->query('SELECT * FROM votes');
	$votes = $query->fetchAll();
	//A quoi sert cette ligne results ?
	$results = array();
	$compteur = 0;

	//
	foreach($votes as $_vote)
	{
		$name = $_vote ['name'];

		if (empty($results[$name]))
			$results[$name] = 0;
		
		$results[$name]++;
		$compteur++;
	}

	if (isset($_COOKIE['token'])){
		$dejavote = 1;
	} else {
		$dejavote = 0;
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>POLL PHP</title>
	<link rel="stylesheet" href="src/css/reset.css">
	<link rel="stylesheet" href="src/css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Kameron:400,700' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,500' rel='stylesheet' type='text/css'>
</head>
<body>
	<div class="container">
		<!-- HEADER -->
		<header>
			<h1>Festival International du Film Héticien</h1>
		</header>

		<!-- CONTENT -->
		<div class="content">

			<p class="description">Vous êtes ici pour voter afin d'élir votre film préféré. Votez pour un film et découvrez les résultats !</p>
			
			<?php if ($dejavote == 0) { ?>
				<form action="#" method="post">
					<input type="hidden" name="name" value="0" id="cachey"/>
			<?php foreach($values as $_key=> $_value): ?>
					<img src="src/img/<?php echo $_key;?>.png" onclick="change_value('<?php echo $_key;?>');" id="<?php echo $_key;?>" onmouseover="this.style.cursor = 'pointer';" class="poster">				
			<?php endforeach; ?>
					<br/><input type="submit" class="valider">
				</form>
			<?php } else { ?>
			<div class="warning">Vous avez déjà voté. Point de fourberies avec nous m'voyez...</div>
			<?php } ?>

			<?php 
			// pour organiser du plus grand au plus petit
			arsort ($results);

			/*echo '<pre>';
			print_r($results);
			echo '</pre>';*/
			?>
			
			<p class="results"><?php echo 'Le Portrait : '.($results['leportrait'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['leportrait'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'Maya : '.($results['maya'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['maya'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'Clear Out : '.($results['clearout'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['clearout'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'Twilight : '.($results['twilight'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['twilight'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'Men In Black : '.($results['meninblack'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['meninblack'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'Sharknado : '.($results['sharknado'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['sharknado'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'National Treasure : '.($results['nationaltreasure'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['nationaltreasure'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

			<p class="results"><?php echo 'Hunger Games : '.($results['hungergames'] / $compteur)*100 . '%'; ?></p>
			<div class="dataviz-bg">
				<div class="dataviz" style="width:<?php echo round(($results['hungergames'] / $compteur)*100); ?>%; background-color:#B80000;"></div>
			</div>

		</div>

		<!-- FOOTER -->
		<footer>
			Made By <a href="https://twitter.com/Victor_Chartier">Victor CHARTIER</a> and <a href="https://twitter.com/ChucKN0risK">Louis CHENAIS</a>
		</footer>
	</div>

	<!-- Script en fin de page pour ne pas ralentir le chargement des éléments principaux de la page-->
	<script>
	function change_value(lenom){

				document.getElementById("cachey").value = lenom; 
				console.log(document.getElementById("cachey").value);

				change_border(lenom);
			}

	function change_border(lenom){
	
				<?php foreach($values as $_key=> $_value): ?>
				document.getElementById('<?php echo $_key;?>').style.border = "0px";
				<?php endforeach; ?>
				document.getElementById(lenom).style.border = "2px solid #B80000";
			}
	</script>
</body>
</html>