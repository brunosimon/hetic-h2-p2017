<?php 
	require 'includes/config.php';
	
	require 'includes/submit.php'; 

	$values1 = array(
		'etudiant'       => 'Etudiant',
		'intervenant'    => 'Intervenant',
		'administration' => 'Administration',
		'technicien'     => 'Technicien',
		'autre'          => 'Autre'
	);

	$values2 = array(
		'oui1' => 'Oui',
		'non1' => 'Non'

	);

	$values3 = array(
		'oui2' => 'Oui',
		'non2' => 'Non'
	);

	$values4 = array(
		'foot'                                       => 'Foot',
		'rugby'                                      => 'Rugby',
		'handball'                                   => 'Handball',
		'natation'                                   => 'Natation',
		'curling'                                    => 'Curling',
		'lance de nain'                              => 'Lancé de nain',
		'ulm'                                        => 'ULM',
		'j\'ai répondu non à la question précédente' => 'J\'ai répondu non à la question précédente',
	);

	$values5 = array(
		'babyfoot'            => 'Babyfoot',
		'billard'             => 'Billard',
		'flechettes'          => 'Flechettes',
		'trampoline'          => 'Trampoline',
		'barre de pole dance' => 'Barre de pole dance',
		'un simulateur de f1' => 'Un simulateur de F1',
		'un punching ball'    => 'Un punching ball'
	);

?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Poll Emploi</title>	
		<link href='http://fonts.googleapis.com/css?family=Raleway:700,300,500' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="src/css/style.css">
	</head>
	<body>
		<div class="content">
			<h1>Hetic Poll Emploi</h1>
			<div class="pseudo">
			    <form action="#" method="post" id="intro">
			    	<p><label for="pseudo" name="pseudo">Entrez votre nom :</label></p>
			    	<p><input type="text" id="pseudo" name="pseudo" placeholder="Votre nom" required autofocus></p>
			    	<input type="submit" class="submitpseudo" value="Lancer le sondage">
			    </form>
			</div>
			
			<div class="question1 hidden">
			    <form action="#" method="post" name="q1" id="q1">
			    	<h2>Question 1</h2>
			    	<h3>Quel est votre statut à HETIC ?</h3>
			    	<?php foreach($values1 as $_key => $_value): ?>
			    		<div class="response">
			    		<input required type="radio" name="name1" value="<?php echo $_key ?>" id="<?php echo $_key ?>" class="val1">
			    		<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
			    		</div>
			    	<?php endforeach; ?>
			    	<br /><br /><input type="submit" class="submit1" value="Continue"/>
			    </form>
			</div>
			
			<div class="question2 hidden">
			    <form action="#" method="post" id="q2">
			    	<h2>Question 2</h2>
			    	<h3>Pratiquez-vous un sport en dehors d'HETIC ?</h3>
			    	<?php foreach($values2 as $_key => $_value): ?>
			    		<div class="response">
			    		<input required type="radio" name="name2" value="<?php echo $_key ?>" id="<?php echo $_key ?>">
			    		<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
			    		</div>
			    	<?php endforeach; ?>
			    	<br /><br /><input type="submit" class="submit2" value="Continue"/>
			    </form>
			</div>
			
			<div class="question3 hidden">
			    <form action="#" method="post" name="q3" id="q3">
			    	<h2>Question 3</h2>
			    	<h3>Souhaiteriez-vous qu'HETIC propose un sport au sein de l'etablissement</h3>
			    	<?php foreach($values3 as $_key => $_value): ?>
			    		<div class="response">
			    		<input required type="radio" name="name3" value="<?php echo $_key ?>" id="<?php echo $_key ?>">
			    		<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
			    		</div>
			    	<?php endforeach; ?>
			    	<br /><br /><input type="submit" class="submit3" value="Continue"/>
			    </form>
			</div>
			
			<div class="question4 hidden">
			    <form action="#" method="post" id="q4">
			    	<h2>Question 4</h2>
			    	<h3>Si Oui, lequel ? (1 choix possible)</h3>
			    	<?php foreach($values4 as $_key => $_value): ?>
			    		<div class="response">
			    		<input required type="radio" name="name4" value="<?php echo $_key ?>" id="<?php echo $_key ?>">
			    		<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
			    		</div>
			    	<?php endforeach; ?>
			    	<br /><br /><input type="submit" class="submit4" value="Continue"/>
			    </form>
			</div>
			
			<div class="question5 hidden">
			    <form action="#" method="post" id="q5">
			    	<h2>Question 5</h2>
			    	<h3>Si vous deviez rajouter quelque chose dans les espaces détentes, ce serais ? (1 choix possible)</h3>
			    	<?php foreach($values5 as $_key => $_value): ?>
			    		<div class="response">
			    		<input required type="radio" name="name5" value="<?php echo $_key ?>" id="<?php echo $_key ?>">
			    		<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
			    		</div>
			    	<?php endforeach; ?>
			    	<br /><br /><input type="submit" class="submit5" value="Continue"/>
			    </form>
			</div>
			
			<div class="results hidden">
			    Merci d'avoir participé à notre sondage.
			</div>
		</div>

		<script type="text/javascript" src="src/js/jquery.js"></script>
		<script type="text/javascript" src="src/js/script.js"></script>

		
	</body>
</html>