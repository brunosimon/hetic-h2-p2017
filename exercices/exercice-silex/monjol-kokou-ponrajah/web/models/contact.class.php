<?php 

/**
* Contact Model
*/
class Contact_Model
{
	
	function __construct($pdo)
	{
		$this->pdo = $pdo;
	}

	/*Submit contact form and mail*/
	function contact($form)
	{
		$prepare = $this->pdo->prepare('
			INSERT INTO 
				contact 
					(
						name, email, subject, content
					) 
				VALUES 
					(
						:name, :email, :subject, :content
					)
			');

		$prepare->bindValue('name',$form['name'],PDO::PARAM_STR);
		$prepare->bindValue('email',$form['email'],PDO::PARAM_STR);
		$prepare->bindValue('subject',$form['subject'],PDO::PARAM_STR);
		$prepare->bindValue('content',$form['content'],PDO::PARAM_STR);
		$prepare->execute();

		mail(
			'alexandre.monjol@gmail.com', 
			$form['subject'], 
			$form['content'],
			'FROM'.$form['name']
			);

		echo '<p class="text-success">Mail envoyé !</p>';

	}


}