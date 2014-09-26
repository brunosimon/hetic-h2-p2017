<?php

/**
* 
*/
class Contact_Model
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function sanetize($data)
	{
		$data['name'] 		= strip_tags(trim($data['name'])); // TRIM m'enlève les espaces tapés dans le name et STRIP_TAGS enpêche à l'utilisateur d'écrire du HTML dans le name
		$data['email']		= strip_tags(trim($data['email']));
		$data['subject'] 	= strip_tags(trim($data['subject']));
		$data['message'] 	= strip_tags(trim($data['message']));

		return $data;
	}

	function check($data)
	{
		$errors = array();

		// name
		if(empty($data['name']))
			$errors['name'] = 'You should fill name !'; // name pas rempli
		else if(strlen($data['name']) < 3)
			$errors['name'] = 'name should be 3 chars length minimum !'; // le name ne doit avoir moin de 3 caractères
		else if(strlen($data['name']) > 30)
			$errors['name'] = 'name should be 30 chars length maximum !'; // le name ne doit pas dépasser plus de 30 caractères

			// EMAIL
		if(empty($data['email']))
			$errors['email'] = 'You should fill email !'; // email pas rempli
		else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL))
			$errors['email'] = 'Wrong email !';

		// subject
		if(empty($data['subject']))
			$errors['subject'] = 'You should fill subject !'; // subject pas rempli
		else if(strlen($data['subject']) < 3)
			$errors['subject'] = 'subject should be 3 chars length minimum !'; // le subject ne doit avoir moin de 3 caractères
		else if(strlen($data['subject']) > 30)
			$errors['subject'] = 'subject should be 30 chars length maximum !'; // le subject ne doit pas dépasser plus de 30 caractères

		// message
		if(empty($data['message']))
			$errors['message'] = 'You should fill message !'; // message pas rempli
		else if(strlen($data['message']) < 3)
			$errors['message'] = 'message should be 3 chars length minimum !'; // le message ne doit avoir moin de 3 caractères
		else if(strlen($data['message']) > 30)
			$errors['message'] = 'message should be 30 chars length maximum !'; // le message ne doit pas dépasser plus de 30 caractères


		return $errors;
	}
		
	function insert($data)
	{
		// print_r($data);
		// exit;`

		$state = array();

		if (filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
			$prepare = $this->pdo->prepare('
			INSERT INTO
				contact (name,email,subject,message)
			VALUES
				(:name,:email,:subject,:message)
			');
			$prepare->bindValue(':name',$data['name']);
			$prepare->bindValue(':email',$data['email']);
			$prepare->bindValue(':subject',$data['subject']);
			$prepare->bindValue(':message',$data['message']);

			$execute = $prepare->execute();
			$state['sent'] = 'Your message is sent';
			return $state;
		}
		else{
			$state['wrong_email'] = 'Wrong email';
			return $state;
		}
		
		
	}

	


}
