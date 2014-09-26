<?php 

// Contact form

class Contact_Model
{
	function __construct($pdo) 
	{
		$this->pdo = $pdo; 
	}


	function add($data) 
	{
		$name = $_POST['name'];
		$mail = $_POST['mail'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];

		if(!filter_var($mail, FILTER_VALIDATE_EMAIL))
		{
		  echo "Votre email est invalide, veuillez recommencer";
		}
		else
		{
		  	//nous avons décidé de stocker les mails dans une base de donnée, étant donné que l'envoi de mail ne fonctionnait pas en local
			$prepare = $this->pdo->prepare("INSERT INTO mail (name, mail, subject, message) VALUES (:name, :mail, :subject, :message)");
			$prepare->bindValue(':name', $name);
			$prepare->bindValue(':mail', $mail);
			$prepare->bindValue(':subject', $subject);
			$prepare->bindValue(':message', $message);
			$prepare->execute();
		}
		
	}   

}
