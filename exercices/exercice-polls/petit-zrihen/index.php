<?php
require_once 'config.php'; 

	$values1 = array(
		'1' => '1', // KEY = VALUES
		'2' => '2',
	
		);

	$values2 = array(
		'3'     => '3',
		'4'     => '4',

		);

	$values3 = array(
		'5'    => '5',
		'6'    => '6',

		);

	$values4 = array(
		'7'    => '7' ,
		'8'    => '8',

		);

	$values5 = array(
		'9'    => '9',
		'10'   => '10',

		);

	$values6 = array(
		'11'    => '11',
		'12'    => '12',

		);

	$values7 = array(
		'13'    => '13',
		'14'    => '14',

		);

	$values8 = array(
		'15'    => '15',
		'16'    => '16',

		);

	$values9 = array(
		'17'    => '17',
		'18'    => '18',

		);

	$values10 = array(
		'19'    => '19',
		'20'    => '20',

		);








	if(!empty($_POST))
	{

		if(!empty($_POST['name1']) && !empty($_POST['name2']) && !empty($_POST['name3']) && !empty($_POST['name4']) && !empty($_POST['name5']) && !empty($_POST['name6']) && !empty($_POST['name7']) && !empty($_POST['name8']) && !empty($_POST['name9']) && !empty($_POST['name10']))
		
		{
			$name1 = $_POST['name1'];
			$name2 = $_POST['name2'];
			$name3 = $_POST['name3'];
			$name4 = $_POST['name4'];
			$name5 = $_POST['name5'];
			$name6 = $_POST['name6'];
			$name7 = $_POST['name7'];
			$name8 = $_POST['name8'];
			$name9 = $_POST['name9'];
			$name10 = $_POST['name10'];

			


			$req = 'INSERT INTO votes (name1,name2,name3,name4,name5,name6,name7,name8,name9,name10) VALUES (:name1, :name2, :name3, :name4, :name5, :name6, :name7, :name8, :name9, :name10)';
			$stmt = $pdo -> prepare($req);
			$stmt->execute(array('name1' => $name1,'name2' => $name2,'name3' => $name3,'name4' => $name4,'name5' => $name5,'name6' => $name6,'name7' => $name7,'name8' => $name8,'name9' => $name9,'name10' => $name10));
		

			header('Location:result.php');
		}
	}


	$results = array();
	$query = $pdo->query('SELECT * FROM votes');
	$votes = $query->fetchAll();

	foreach ($votes as $_vote) 
	
	{
		if(empty($results[$_vote['name1']])){
			$results[$_vote['name2']] = 0;
			$results[$_vote['name3']] = 0;
			$results[$_vote['name4']] = 0;
			$results[$_vote['name5']] = 0;
			$results[$_vote['name6']] = 0;
			$results[$_vote['name7']] = 0;
			$results[$_vote['name8']] = 0;
			$results[$_vote['name9']] = 0;
			$results[$_vote['name10']] = 0;
		
		}

		$results[$_vote['name1']]++; 
		$results[$_vote['name2']]++;
		$results[$_vote['name3']]++;
		$results[$_vote['name4']]++;
		$results[$_vote['name5']]++;
		$results[$_vote['name6']]++;
		$results[$_vote['name7']]++;
		$results[$_vote['name8']]++;
		$results[$_vote['name9']]++;
		$results[$_vote['name10']]++;
	}

	arsort($results);					//trie les votes par nombres de choix

	echo '<pre>';
	print_r($results);
	echo '</pre>';


?>



<!doctype html>
<html lang="en">
	<head>
	<meta charset="UTF-8">
	<title>Poll</title>

	</head>
<body>
	
	<h1>Questionnaire J.PETIT & Alexis ZRIHEN </h1>
		<h2> L'ombre et la lumière <h2>

	<form action="#" method="post" id="1">
		<h2>Question 1</h2>
		<h3>Suivez-vous les règles à la lettre ? </h3>
		<?php foreach($values1 as $_key => $_value): ?>
			<input class = 'rep1' type="radio" name="name1" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 2</h2>
		<h3>Seriez-vous prêt de risquer votre mission pour sauver la vie d'un ami?</h3>
		<?php foreach($values2 as $_key => $_value): ?>
			<input class = 'rep2' type="radio" name="name2" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 3</h2>
		<h3>Quel est votre style de combat?</h3>
		<?php foreach($values3 as $_key => $_value): ?>
			<input class = 'rep3' type="radio" name="name3" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 4</h2>
		<h3>Croyez-vous que le but du jedi est de conduire des êtres inférieurs loin de l'obscurité?</h3>
		<?php foreach($values4 as $_key => $_value): ?>
			<input class = 'rep4' type="radio" name="name4" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 5</h2>
		<h3>Croyez-vous le Jedi doit combattre le mal partout où ils le trouver?</h3>
		<?php foreach($values5 as $_key => $_value): ?>
			<input class = 'rep5' type="radio" name="name5" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 6</h2>
		<h3>Pensez-vous que l'amour est approprié pour un Jedi?</h3>
		<?php foreach($values6 as $_key => $_value): ?>
			<input class = 'rep6' type="radio" name="name6" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>" name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 7</h2>
		<h3>La fin justifie les moyens?</h3>
		<?php foreach($values7 as $_key => $_value): ?>
			<input class = 'rep7' type="radio" name="name7" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>"name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 8</h2>
		<h3>Quel est le plus important, l'expérience ou intuition?</h3>
		<?php foreach($values8 as $_key => $_value): ?>
			<input class = 'rep8' type="radio" name="name8" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>"name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>

	

		<h2>Question 9</h2>
		<h3>Des couleurs suivantes quelle est votre préférence: vert, violet ou bleu?</h3>
		<?php foreach($values9 as $_key => $_value): ?>
			<input class = 'rep9' type="radio" name="name9" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>"name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>
	

		<h2>Question 10</h2>
		<h3>D'où vient l'autorité d'un Jedi venir?</h3>
		<?php foreach($values10 as $_key => $_value): ?>
			<input class = 'rep10' type="radio" name="name10" value="<?php echo $_key ?>" id="<?php echo $_key ?>" required="required">
			<label for="<?php echo $_key ?>"name="<?php echo $_key ?>"><?php echo $_value ?></label>
		<?php endforeach; ?>
		<br /><input type="submit" class="submit10">
	</form>

	<script src="../js/js.js"></script>

</body>
	
</html>


