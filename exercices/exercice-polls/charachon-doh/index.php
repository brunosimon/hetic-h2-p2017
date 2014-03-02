<?php 

	//TODO LIST

	// - quand on a fait les 10 questions, on recherche la catégorie la + choisie et on stocke le résultat dans "results"
	
	// EASY - remplir "results" avec des profils pour pouvoir faire des stats dès le début
	// EASY - description des profils designer, développer, marketer

	// BONUS - personnaliser les radio button

	require_once'config.php';

	if(!empty($_POST)) {
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';

	//si on coche une réponse, on la stocke dans votes
		$exec = $pdo->exec('INSERT INTO votes (name) VALUES (\''.$_POST['name'].'\')');
	} 

	$question = isset($_GET['question']) ? $_GET['question'] : '';
 ?>

 <!doctype html>
 <html lang="fr">
 <head>
 	<meta charset="UTF-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
 	<title>Quel profil d'héticien es-tu ?</title>

 	<!--  STYLES -->
 	<link rel="stylesheet" type="text/css" href="src/css/reset.css">
 	<link rel="stylesheet" type="text/css" href="src/css/style.css">
 </head>

 <body>

 	<!-- RANDOM BG -->
 	<script>
	    var bgcolorlist = new Array("#70a136","#3894a8","#c59150","#827bd3","#de9bcd","#349c93","#bbcc65","#c77a57");
	    var randomColor = bgcolorlist[Math.floor(Math.random()*bgcolorlist.length)];
	    document.body.style.background = randomColor;
	</script>

 	<!-- PAGE RESULTAT-->
 	<?php if ($question == 'result'):

 	//////////////    DEBUT TABLE VOTES    ////////////////// 
 		$query = $pdo->query('SELECT * FROM votes');

 		$votes = array();

	 	while ($vote = $query->fetch())
	 	{
	 		$votes[] = $vote['name']; 
	 	}

	 	$designer = 0;
	 	$developer = 0;
	 	$marketer = 0;

	 	// on compte le nombre profil
	 	for ($i=0; $i < 10 ; $i++) { 
	 		
	 		switch($votes[$i])
		    {
		        case 'designer':
		            $designer++;
		            break;
		        case 'developer':
		            $developer++;
		            break;
		        case 'marketer':
		            $marketer++;
		            break;
		    }
	 	}

	 	//on compare le nombre de résultats obtenus pour chaque profil, puis on stocke le profil obtenue dans la table results
	 	if ($designer > $developer && $designer > $marketer)
	 	{
	 		$exec = $pdo->exec('INSERT INTO results (result) VALUES (\'designer\')');
	 		echo '<div class="img_result"> 
	 					<h3> Vous êtes un designer !</h3> 
	 					<img src="src/img/bubble/designer.png" alt="designer" class="bubble">
	 					<img src="src/img/character/designer.png" alt="designer" class="img_designer">
	 				</div>';
	 	
	 	}
	 	else if ($developer > $designer && $developer > $marketer)
	 	{
	 		$exec = $pdo->exec('INSERT INTO results (result) VALUES (\'developer\')');
	 		echo '<div class="img_result"> 
	 					<h3> Vous êtes un développeur !</h3> 
	 					<img src="src/img/bubble/developer.png" alt="developer" class="bubble">
	 					<img src="src/img/character/developer.png" alt="developer" class="img_designer">
	 				</div>';

	 	
	 	}
	 	else if ($marketer > $developer && $marketer > $designer)
	 	{
	 		$exec = $pdo->exec('INSERT INTO results (result) VALUES (\'marketer\')');
	 		echo '<div class="img_result"> 
	 					<h3> Vous êtes un marketeur !</h3> 
	 					<img src="src/img/bubble/marketer.png" alt="marketer" class="bubble">
	 					<img src="src/img/character/marketer.png" alt="marketer" class="img_designer">
	 				</div>';
	 	
	 	}// au cas ou il y a un ex aequo à l'issu du sondage 4/4/2  ou 5/5/0, et ON NE STOCKE PAS dans la bdd results
	 	else if ($marketer = $designer || $marketer = $developer || $developer = $designer )
	 	{
	 		echo '<div class="img_result"> 
	 					<h3> Mmmmh...il semblerait que tu sois polyvalent !</h3> 
	 					<img src="src/img/character/designer.png" alt="designer" class="img_exaequo">
	 					<img src="src/img/character/marketer.png" alt="marketer" class="img_exaequo">
	 					<img src="src/img/character/marketer.png" alt="developer" class="img_exaequo">
	 				</div>';
	 	}

	 	//////////////    FIN TABLE VOTES                //////////////////

	 	//////////////    DEBUT TABLE RESULTS            //////////////////

	 	$query = $pdo->query('SELECT * FROM results');

 		$results = array();

	 	while ($result = $query->fetch())
	 	{
	 		$results[] = $result['result']; 
	 	}

	 	$designerResult = 0;
	 	$developerResult = 0;
	 	$marketerResult = 0;

	 	// on compte le nombre profil
	 	for ($i=0; $i < sizeof($results) ; $i++) { 
	 		
	 		switch($results[$i])
		    {
		        case 'designer':
		            $designerResult++;
		            break;
		        case 'developer':
		            $developerResult++;
		            break;
		        case 'marketer':
		            $marketerResult++;
		            break;
		    }
	 	}

	 	$total = $designerResult+$developerResult+$marketerResult;

	 	// echo $designerResult ;
	 	// echo $developerResult ;
	 	// echo $marketerResult ;

	 	echo '<p class="global_result">Il y a '.$designerResult.' designers, '.$developerResult.' développeurs et '.$marketerResult.' marketeurs, sur un total de '.$total.' personnes. </p>';

	 	// echo'<pre>';
	 	// print_r($results);
	 	// echo'</pre>';

	 	//////////////    FIN TABLE RESULTS            //////////////////

	 	// echo'<pre>';
	 	// print_r($votes);
	 	// echo'</pre>';
 	?>
 	
 	<!-- PAGE QUESTION-->	
 	<?php else: ?>
 	<form action="index.php?question=<?php if($question<10){echo $question+1;}else{echo 'result';}?>" method="post" onsubmit="window.location.reload()" >
 	
 		<?php 

	 		$query = $pdo->query('SELECT * FROM questions WHERE id='.$question);
	 		$votes = $query->fetch();

 			// echo '<pre>';
 			// print_r($votes);
 			// echo '</pre>'; 
 		?>

 		<!--  QUESTION -->
 		<h2 class="question"><?php echo $votes['question']; ?></h2>

 		<div class="container">
 			<!-- CHOICE 1 -->
			<input type="radio" name="name" value="developer" id="choice1" required>
			<label for="choice1"><?php echo $votes['choice1']; ?></label> <br />

			<!-- CHOICE 2 -->
			<input type="radio" name="name" value="marketer" id="choice2" required>
			<label for="choice2"><?php echo $votes['choice2']; ?></label> <br />

			<!-- CHOICE 3-->
			<input type="radio" name="name" value="designer" id="choice3" required>
			<label for="choice3"><?php echo $votes['choice3']; ?></label>
		</div>

 		<br /><input type="submit" class="submit" value="NEXT">
 	</form>
 	<?php endif; ?>
 </body>
 </html>