<?php 
	error_reporting(E_ALL); 
	ini_set("display_errors", 1);

	$errors 	= array();
	$success 	= array();
	$data 		= array(
		'login'		=> '',
		'email'		=> '',	
		'password'	=> '',
		'age'		=> 25
	);


class Contact_Model
{
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	function add($data)
	{
		$prenom = $_POST['prenom'];
		$nom = $_POST['nom'];
		$email = $_POST['email'];
		$content = $_POST['content'];

		$email = $_POST['email'];
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
		  {
		  echo "Votre email est invalide, veuillez recommencer";
		  }
		else
		  {
		  $prepare = $this->pdo->prepare('INSERT INTO contact (prenom,nom,email,content) VALUES (:prenom,:nom,:email,:content)');
		  $prepare->bindValue(':prenom',$prenom);
		  $prepare->bindValue(':nom',$nom);
		  $prepare->bindValue(':email',$email);
		  $prepare->bindValue(':content',$content);
		  $exec = $prepare->execute();
		  }
	}
}

// le formulaire de contact est enregistré dans la base de donnée, mais n'est pas envoyé par mail, car ça n'est pas possible en local
