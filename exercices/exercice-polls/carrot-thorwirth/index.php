<?php
	require 'config.php';
	
	$values = array(
			'Interessant'			=>'Intéressant',
			'tresinteressant'		=>'Très intéressant',
			'Pasassezinteressant'	=>'Pas assez intéressant',
			'Pasdutoutinteressant'	=>'Pas du tout intéressant',
			'Facile'				=>'Facile',
			'Tropfacile'			=>'Trop facile',
			'Difficile'				=>'Difficile',
			'Tropdifficile'			=>'Trop difficile',
			'Parfait'				=>'Parfait',


	
	);
	
	
	if(!empty($_POST['name']))
		$exec = $pdo->exec('INSERT INTO votes(name) VALUES(\''.$_POST['name'].'\')');
		
	if ((!empty($_POST['name']))&&(!isset($_COOKIE['token']))) {
		setcookie('token','1',time() + 604800,'/');
		$exec = $pdo->exec('INSERT INTO votes (name) VAlUES (\''.$_POST['name'].'\')');
		header('Location: index.php');
		
	}
	
//cookie
	if (isset($_COOKIE['token'])){
		$dejavote = 1;
	} else {
		$dejavote = 0;
	}
	
		
		//pour le classement
	$query = $pdo->query('SELECT * FROM votes');
	$votes = $query->fetchAll();
	$results = array();
	
	foreach($votes as $_vote)
	{
		$name = $_vote['name'];
		
		if(empty($results[$name]))
			$results[$name] = 0;
		
		$results[$name]++;
	}
	
	arsort($results);
	
	//echo '<pre>';
	//print_r($results);
	//echo '</pre>';
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> TD-trimestre2-CARROT-THORWIRTH</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
	<?php if ($dejavote == 0) { ?>
	<form action="#" method="post">
	<legend> Comment avez vous trouvez le cours d'aujourd'hui ? </legend>
		<?php foreach($values as $_key => $_value): ?>
	        </br><input type="radio" name="name" value="<?php echo $_key; ?>"id="<?php echo $_key; ?>">
			<label for="<?php echo $_key; ?>"><?php echo $_value; ?></label>
			<?php endforeach; ?>
		</br><input type="submit" class="validation">
	</form>
	
	
	<?php } else { 
	
	?><div class="perfect"><?php
	// Résultat Parfait

					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
						$results[$name] = 0;
		
						$results[$name]++;
						$total++;
					}

					arsort ($results);
					if($total)
					echo 'Parfait : '.round(($results['Parfait'] / $total)*100, 0) . '%';
					
					else
						echo 'Parfait : 0%';
	
?>
					<div class="compteur">
						<div class="jauge" style="width:<?php echo round(($results['Parfait'] / $total)*100	); ?>%; height:15px; background-color:#1FBA55;"></div>	
					</div> 	
<?php
	
	// Résultat trèes interessant

						$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
							$results[$name] = 0;
						
						$results[$name]++;
						$total++;
					}
					arsort ($results);
					if($total)
				
						echo 'Très intéressant : '.round(($results['tresinteressant'] / $total)*100, 0) . '%';
					else
						echo 'Très intéressant : 0%';
					?>	

					<div class="compteur">
						<div  class="jauge" style="width:<?php echo round(($results['tresinteressant'] / $total)*100); ?>%; height:15px; background-color:#1FBA55;"></div>
					</div> 
<?php	
// RESULTAT INTERESSANT	
					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
							$results[$name] = 0;
						
						$results[$name]++;
						$total++;
					}
					arsort ($results);
					if($total)

						echo 'Intéressant : '.round(($results['Interessant'] / $total)*100, 0) . '%';
					else
						echo 'Intéressant : 0%';
					?>	

					<div class="compteur">
						<div  class="jauge" style="width:<?php echo round(($results['Interessant'] / $total)*100); ?>%; height:15px; background-color:#1FBA55;"></div>
					</div> 	
						
					</div>
						
		
<div class="notperfect"><?php
// Résultat Pas assez interessant
				
						$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
							$results[$name] = 0;
						
						$results[$name]++;
						$total++;
					}
					arsort ($results);
					if($total)
						echo 'Pas assez intéressant : '.round(($results['Pasassezinteressant'] / $total)*100, 0) . '%';
					else
						echo 'Pas assez intéressant : 0%';
				
				?>
				<div class="compteur">
					<div  class="jauge" style="width:<?php echo round(($results['Pasassezinteressant'] / $total)*100); ?>%; height:15px; background-color:#d2665a;"></div>
				</div> 	
<?php	
	// Résultat Pas du tout interessant

					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
						$results[$name] = 0;
		
						$results[$name]++;
						$total++;
					}

					arsort ($results);
					if($total)
						echo 'Pas du tout intéressant : '.round(($results['Pasdutoutinteressant'] / $total)*100, 0) . '%';
					else
						echo 'Pas du tout intéressant : 0%';
?>
	<div class="compteur">
		<div  class="jauge" style="width:<?php echo round(($results['Pasdutoutinteressant'] / $total)*100); ?>%; height:15px; background-color:#d2665a;"></div>	</div> 	
<?php		
		
	// Résultat FACILE

					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
						$results[$name] = 0;
		
						$results[$name]++;
						$total++;
					}

					arsort ($results);
					if($total)
						echo 'Facile : '.round(($results['Facile'] / $total)*100, 0) . '%';
					else
						echo 'Facile : 0%';
?>
	<div class="compteur">
		<div  class="jauge" style="width:<?php echo round(($results['Facile'] / $total)*100); ?>%; height:15px; background-color:#d2665a;"></div>	
	</div> 	
	
<?php

	// Résultat Trop Facile

					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
						$results[$name] = 0;
		
						$results[$name]++;
						$total++;
					}

					arsort ($results);
					if($total)
						echo 'Trop facile : '.round(($results['Tropfacile'] / $total)*100, 0) . '%';
					else
						echo 'Trop facile : 0%';
?>


	<div class="compteur">
		<div  class="jauge" style="width:<?php echo round(($results['Tropfacile'] / $total)*100); ?>%; height:15px; background-color:#d2665a;"></div>	
	</div> 	
	
<?php

	// Résultat Difficile

					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
						$results[$name] = 0;
		
						$results[$name]++;
						$total++;
					}

					arsort ($results);
					if($total)
						echo 'Difficile : '.round(($results['Difficile'] / $total)*100, 0) . '%';
					else
						echo 'Difficile : 0%';
?>
	<div class="compteur">
		<div  class="jauge" style="width:<?php echo round(($results['Difficile'] / $total)*100); ?>%; height:15px; background-color:#d2665a;"></div>	
	</div> 	
	
<?php

	// Résultat Trop difficile

					$query = $pdo->query('SELECT * FROM votes');
					$votes = $query->fetchAll();
					$results = array();
					$total = 0;
					foreach($votes as $_vote)
					{
						$name = $_vote ['name'];
						if (empty($results[$name]))
						$results[$name] = 0;
		
						$results[$name]++;
						$total++;
					}

					arsort ($results);
					if($total)
						echo 'Trop difficile : '.round(($results['Tropdifficile'] / $total)*100, 0). '%';
					else
						echo 'Trop difficile : 0%';
?>
	<div class="compteur">
		<div  class="jauge" style="width:<?php echo round(($results['Tropdifficile'] / $total)*100); ?>%; height:15px; background-color:#d2665a;"></div>	
	</div> 	
	</div>
		
	<div class="total">
		<p>Merci !</br><strong><?php echo $total; ?></strong> élèves ont voté !</p>
	</div>
</div>

	
<?php

				

		} ?>

</body>
</html>
