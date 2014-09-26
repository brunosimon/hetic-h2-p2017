<?php

if(isset($_POST) && isset($_POST['nom']) && isset($_POST['email']) && isset($_POST['contenu']))
	{ 
		extract($_POST);
		if(!empty($nom) && !empty($email) && !empty($contenu))
		{
			$message-addslashes($message);
			$destinataire="tr.richard78@gmail.com";
			$sujet="Formulaire de contact";
			$msg-"Test email \n 
			Nom 	: $nom -
			Email	: $email -
			Message : $message"; 
			$entete="From: $nom - Reply-to: $email";
			mail($destinataire,$sujet,$msg,$entete)
			
		}
		else{
			echo "please fill the form";
		}	
	}


?>