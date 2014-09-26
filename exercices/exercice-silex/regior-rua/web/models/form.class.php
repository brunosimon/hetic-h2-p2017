<?php

	/**
	* Form Model
	*/

	// Gestion des formulaires sur le site

class Form_Model
{

	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	//Ajouter les contacts à la BDD
	function addContact($form)
	{

		//on initialise la requête
		$query = $this->pdo->prepare("
			INSERT INTO contact
				(
					username,
					email,
					subject,
					message
				)
			VALUES
				(
					:username,
					:email,
					:subject,
					:message
				)

		");

		$query->bindvalue('username', $form['name'], PDO::PARAM_STR);
		$query->bindvalue('email', $form['email'], PDO::PARAM_STR);
		$query->bindvalue('subject', $form['subject'], PDO::PARAM_STR);
		$query->bindvalue('message', $form['message'], PDO::PARAM_STR);

		$query->execute();


	}

	//Ajouter des snippets
	function addSnippet($formSnippet)
	{

		//on initialise la requête
		$query = $this->pdo->prepare("
			INSERT INTO snippets
				(
					id_category,
					title,
					content
				)
			VALUES
				(
					:snippetSelect,
					:snippetName,
					:textSnippet
				)
		");

		$query->bindvalue('snippetSelect', $formSnippet['snippetSelect'], PDO::PARAM_INT); //récupérer la value des input radio.
		$query->bindvalue('snippetName', $formSnippet['snippetName'], PDO::PARAM_STR);
		$query->bindvalue('textSnippet', $formSnippet['textSnippet'], PDO::PARAM_STR);

		$query->execute();

	}



}

