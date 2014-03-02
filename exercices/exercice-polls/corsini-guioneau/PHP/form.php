<?php 

	$errors = array();
	$success = array();

	if(!empty($_POST))
	{

		$req_log = $pdo->query('SELECT * FROM users WHERE login = \''.$_POST['login'].'\'');
		$req_em = $pdo->query('SELECT * FROM users WHERE email = \''.$_POST['email'].'\'');

		$don_log = $req_log->fetchAll();
		$don_em = $req_em->fetchAll();

		$data = sanetize($_POST);
		$errors = check($data);

		if(empty($don_log) && empty($don_em)){

			if(empty($errors)){
				$success[] = 'Well done';
				
				$exec = $pdo->exec('INSERT INTO users (login,email) VALUES (\''.$data['login'].'\',\''.$data['email'].'\')');
			}

		}

		else
			echo '<p class="errors">Login or email déjà utilisé</p>';
	}

	else
	{
		$data = array(
			'login' 	=> '',
			'email' 	=> '',
		);
	}

	function sanetize($data)
	{
		$data['login'] = strip_tags(trim($data['login']));
		$data['email'] = strip_tags(trim($data['email']));

		return $data;
	}

	function check($data)
	{
		$errors = array();

		//login
		if(empty($data['login']))
			$errors['login'] = 'Veuillez remplir le champ login';
		else if(strlen($data['login']) < 3)
			$errors['login'] = 'Votre login doit contenir 3 caractères minimum';
		else if(strlen($data['login']) > 20)
			$errors['login'] = 'Votre login doit contenir 20 caractères maximum';

		//email
		if(empty($data['email']))
			$errors['email'] = 'Veuillez remplir le champs email';
		else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			$errors['email'] = 'Email invalide';


		return $errors;
	}

?>