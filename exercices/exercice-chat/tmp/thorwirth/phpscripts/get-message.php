<?php
session_start();
include('functions.php');
// Appel de la fonction de connexion à la base de données
$db = db_connect();

/* On vérifie d'abord que le compte existe, si ce n'est pas le cas, 
on s'arrête, on supprime les sessions et on renvoie 0. */
$checkUser = $db->prepare("SELECT * FROM chat_accounts WHERE account_id = :id AND account_login = :login ");
$checkUser->execute(array('id' => $_SESSION['id'], 'login' => $_SESSION['login']));	
$countUser = $checkUser->rowCount();
if($countUser == 0) 
{
	// On indique qu'il y a une erreur de type unlog
	// donc que l'utilisateur connecté n'a pas de compte
	$json['error'] = 'unlog';
	// On supprime les sessions
	unset($_SESSION['time']);
	unset($_SESSION['id']);
	unset($_SESSION['login']);
} 
else 
{
	// On indique qu'il n'y a aucune erreur
	$json['error'] = '0';
	// ON PEUT CONTINUER !!!
	// Affichage de l'annonce //////////////////////////////////////////
	$query = $db->query("SELECT * FROM chat_annonce LIMIT 0,1");
	while ($data = $query->fetch())
		$json['annonce'] = $data['annonce_text'];
		$query->closeCursor();

	/* On effectue la requête sur la table contenant les messages. On récupère
	les 100 derniers messages. Enfin, on affiche le tout. */

	/* Si vous voulez faire appraître les messages depuis l'actualisation
	de la page, laissez l'AVANT-DERNIERE ligne de la requete, sinon, supprimez-la */
	$query = $db->prepare("SELECT message_id, message_user, message_time, message_text, account_id, account_login FROM chat_messages LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_messages.message_user WHERE message_time >= :time ORDER BY message_time ASC LIMIT 0,100");
	$query->execute(array('time' => $_GET['dateConnexion']));
	$count = $query->rowCount();
	if($count != 0) 
	{
		$json['messages'] = '<div id="messages_content">';
		// On crée un tableau qui continendra notre...tableau
		// Afin de placer les emssages en bas du chat
		// On triche un peu mais c'est plus simple :D
		$json['messages'] .= '<table><tr><td style="height:500px;" valign="bottom">';
		$json['messages'] .= '<table style="width:100%">';

		$i = 1;
		$e = 0;
		$prev = 0;
		while ($data = $query->fetch()) 
		{
			// Change la couleur dès que l'ID du membre est différent du précédent
			if($i != 1) 
			{
				$idNew = $data['message_user'];		
				if($idNew != $id) 
				{
					if($colId == 1) 
					{
						$color = '#077692';
						$colId = 0;
					} 
					else 
					{
						$color = '#666';
						$colId = 1;
					}
					$id = $idNew;
				} 
				else
					$color = $color;
			} 
			else 
			{
				$color = '#666';
				$id = $data['message_user'];
				$colId = 1;
			}


			$text .= '<tr><td style="width:15%" valign="top">';
			// Si le dernier message est du même membre, on écrit pas de nouveau son pseudo
			if($prev != $data['account_id']) 
			{
				// contenu du message	
				$text .= '<a href="#post" onclick="insertLogin(\''.addslashes($data['account_login']).'\')" style="color:black">';
				$text .= date('[H:i]', $data['message_time']);
				$text .= '&nbsp;<span style="color:'.$color.'">'.$data['account_login'].'</span>';
				$text .= '</a>';	
			}
			$text .= '</td>';			
			$text .= '<td style="width:85%;padding-left:10px;" valign="top">';

				
			// On supprime les balises HTML
			$message = htmlspecialchars($data['message_text']); 

			// On transforme les liens en URLs cliquables
			$message = urllink($message);
				
			// Si le nom apparaît suivi de >, on le colore en orange
			if(user_verified())
			{
				if(preg_match('#'.$_SESSION['login'].'&gt;#is', $message)) 
				{
					$message = preg_replace('#'.$_SESSION['login'].'&gt;#is', '<b><span style="color:orange;">'.$_SESSION['login'].'&gt;</span></b>', $message);
				}
			}
				
			// On ajoute le message en remplaçant les liens par des URLs cliquables
			$text .= $message.'<br />';
			$text .= '</td></tr>';

			$i++;
			$prev = $data['account_id'];
		}
			
		/* On crée la colonne messages dans le tableau json
		qui contient l'ensemble des messages */
		$json['messages'] = $text;

		$json['messages'] .= '</table>';
		$json['messages'] .= '</td></tr></table>';
		$json['messages'] .= '</div>';			
	} 
	else 
	{
		$json['messages'] = 'Aucun message n\'a été envoyé pour le moment.';
	}
	$query->closeCursor();
}

$checkUser->closeCursor();

// Encodage de la variable tableau json et affichage
echo json_encode($json);

?>