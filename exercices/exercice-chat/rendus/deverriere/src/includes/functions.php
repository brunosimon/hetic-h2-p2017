<?php
	function checkInscription($data)
	{
		require_once 'connect.php'; 
		if(!empty($data['login']) && !empty($data['password']) && !empty($data['verif-password']))
		{
			$login = $data['login'];
			$pass = $data['password'];
			$verif = $data['verif-password'];
			
			
			if ( $pass == $verif )
			{
				$query = $pdo->prepare('SELECT * FROM users WHERE login = :login');
				$query->bindValue(':login', $login);
				$query->execute();
				$user = $query->fetch();
				
				if($user) return 'Login déjà pris';
				else {
					$query = $pdo->prepare('INSERT INTO users(login, password, date_inscription) VALUES(:login, :password, NOW())');
					$query->bindValue(':login', $login);
					$query->bindValue(':password', hash('sha256', $pass.SALT));
					$query->execute();
					
					return 'WOUHOU';
					header('Location: index.php');
					exit;
				}
			}
			else
			{
				return 'Les mots de passe ne correspondent pas.';
			}
			
		}
		else
		{
			return 'Vous avez oublié de remplir un ou plusieurs champ(s)';
		}
	}
	
	function checkConnection($data)
	{
		require_once 'connect.php';
		
		if(!empty($data['login']) && !empty($data['password']))
		{
			$login = $data['login'];
			$pass = $data['password'];
			
			$query = $pdo->prepare('SELECT * FROM users WHERE login = :login');
			$query->bindValue(':login', $login);
			$query->execute();
			$user = $query->fetch();
			
			if($user)
			{
				if(hash('sha256',$pass.SALT) == $user->password)
				{
					$_SESSION['login'] = $login;
					header('Location: chat.php');
					exit;
				}
				else
				{
					return 'Mot de passe incorrect';
				}
			}
			else
			{
				return 'Problème de login';
			}
			
			
		}
		else
		{
			return 'Les mots de passe ne correspondent pas.';
		}
	}
	
	function bbcode($content)
	{
		 $text = stripslashes($content); // On enlève les slashs qui se seraient ajoutés automatiquement pour rien (sécurité 1)
		 $text = htmlspecialchars($text); // On rend inoffensives les balises HTML que le visiteur a pu rentrer 
//		 (marche aussi avec sanetize (sécurité 2))
		 $text = preg_replace('#\[b\](.+)\[/b\]#isU', '<strong>$1</strong>', $text);
		 $text = preg_replace('#\[em\](.+)\[/em\]#isU', '<em>$1</em>', $text); 
		 $text = preg_replace('#\[color=(red|green|blue|yellow|purple|orange)\](.+)\[/color\]#isU', '<span style="color:$1">$2</span>', $text);
		 $text = preg_replace('#http://[a-z0-9._/-]+#i', '<a href="$0">$0</a>', $text);
		 
		 return $text;
	}
	
	function quizz($datas, $login)
	{		
		require_once 'connect.php'; 
		
		if(!empty($datas['name']) && !empty($datas['question']) && !empty($datas['answer']))
		{
			$name = $datas['name'];
			$question = $datas['question'];
			$answer = $datas['answer'];

			$query = $pdo->prepare('SELECT * FROM quizz WHERE nom = :nom OR question = :question');
			$query->bindValue(':nom', $name);
			$query->bindValue(':question', $question);
			$query->execute();
			$quizz = $query->fetch();
			
			if($quizz)
			{
				if($quizz->nom == $name) return 'Nom de la question déjà pris';
				elseif($quizz->question == $question) return 'Question déjà existante';
			}
			else
			{
				$query = $pdo->prepare('INSERT INTO quizz(nom, question, reponse) VALUES(:name, :question, :answer)');
				$query->bindValue(':name', $name);
				$query->bindValue(':question', $question);
				$query->bindValue(':answer', $answer);
				$query->execute();
				return 'Question enregistrée';
				
			}
		}
		else
		{
			return 'Vous avez oublié de remplir un ou plusieurs champ(s)';
		}
			
	}

	function printQuizz()
	{
		require_once 'connect.php'; 
		$query = $pdo->query('SELECT nom FROM quizz');
		$printQuizz = $query->fetchall();
		return $printQuizz;
	}

?>