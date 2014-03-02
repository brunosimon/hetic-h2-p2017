<?php

	$errors = array();
	if (!empty($_POST)) 
	{
			echo '<pre>';
			print_r($_POST);
			echo '</pre>';

			$data = clear($_POST);

				echo '<pre>';
				print_r($data);
				echo '</pre>';

				$errors=check($data);

				echo '<pre>';
				print_r($errors);
				echo '</pre>';

				//si $post n'est pas vide on affiche le tableau <pre> = aller à la ligne et indenter 
	}
	else
	{
		$data = array(
				'login' => '',
				'password' => '',
				'email' => '',
				'age' => 25
			);
	}

	function clear($data)
	{ //on nettoie le tableau pour les espaces en trop par exemple.
		$data['login'] = strip_tags(trim($data['login']));
		$data['password'] = strip_tags(trim($data['password']));
		$data['email'] = strip_tags(trim($data['email']));
		$data['age'] = (int)$data['age']; // dans toute les cas la valeur deviendra un entier, cela marquera zero
		
		return $data; //on nettoie les espaces.
	}

	function check ($data)
		{ //$data c'est ce qu'il y a dans le tableau
			$errors = array();

			//login
			if (empty($data['login'])) //empty test si c'est vide
				$errors['login'] = 'you should field login bitch!';
			else if (strlen($data['login']) < 3)
				$errors['login'] = 'login should be 3 chars length minimum';
			else if (strlen($data['login']) > 30)
				$errors['login'] = 'login should be 30 chars length minimum';

			//password
			if (empty($data['password'])) //empty test si c'est vide
				$errors['password'] = 'you should field password bitch!';
			else if (strlen($data['password']) < 3)
				$errors['password'] = 'password should be 3 chars length minimum';
			else if (strlen($data['password']) > 30)
				$errors['password'] = 'password should be 30 chars length minimum';

			//email
			if (empty($data['email'])) //empty test si c'est vide
				$errors['email'] = 'you should field email bitch!';
			else if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) // point d'exclamation si l'e-mail est faux. Filtre ce que l'on test avec le filtre adéquate
				$errors['email'] = 'wrong email!';

			//age
			if ($data['age'] < 18) 
				$errors['age'] = 'too younggg';


			return $errors;
		}



?>