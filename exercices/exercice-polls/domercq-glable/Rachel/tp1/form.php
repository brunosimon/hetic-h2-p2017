<?php

	$errors = array();
	$success = array();
	if(!empty($_POST))
	{
		// echo '<pre>';
		// print_r($_POST);
		// echo '</pre>';
		// exit; il permet d'arrêter le code


		$data = sanetsize($_POST);
		$errors = check($data);

		if (empty($errors)) { // ON VÉRIFIE QUE 'ERRORS' SOIT VIDE 
			
			$exec = $pdo->exec('INSERT INTO users (login,password,email,age) VALUES (\''.$data['login'].'\',\''.$data['password'].'\',\''.$data['email'].'\',\''.$data['age'].'\')');
			
			$data = array(
				'login' => '',

			// echo '<pre>';
			// print_r($exec); // IL NOUS DIT COMBIEN DE LIGNES ONT ÉTÉ AFFECTÉ
			// echo '</pre>';
			
			$success[] = 'User well registered';
		}
	}

	else
	{
		$data = array(
			'login' => '',

	}

	function sanetsize($data)
	{
		$data['login'] 		= strip_tags(trim($data['login'])); // TRIM m'enlève les espaces tapés dans le LOGIN et STRIP_TAGS enpêche à l'utilisateur d'écrire du HTML dans le LOGIN
	

		return $data;
	}

	function check($data)
	{
		$errors = array();

		// LOGIN
		if(empty($data['name']))
			$errors['name'] = 'You should fill name !'; // name pas rempli
		else if(strlen($data['name']) < 3)
			$errors['name'] = 'name should be 3 chars length minimum !'; // le name ne doit avoir moin de 3 caractères
		else if(strlen($data['name']) > 30)
			$errors['name'] = 'name should be 30 chars length maximum !'; // le name ne doit pas dépasser plus de 30 caractères


		return $errors;


	}


	?>
