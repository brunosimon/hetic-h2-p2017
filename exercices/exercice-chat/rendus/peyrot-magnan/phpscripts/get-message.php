<?php
session_start();
include('functions.php');
$db = db_connect();

$checkUser = $db->prepare("SELECT * FROM chat_accounts WHERE account_id = :id AND account_login = :login ");
$checkUser->execute(array(
	'id' => $_SESSION['id'],
	'login' => $_SESSION['login']
));	
$countUser = $checkUser->rowCount();
if($countUser == 0) {
	$json['error'] = 'unlog';
	unset($_SESSION['time']);
	unset($_SESSION['id']);
	unset($_SESSION['login']);
} else {
	$json['error'] = '0';
}
$checkUser->closeCursor();

$query = $db->prepare("
	SELECT message_id, message_user, message_time, message_text, account_id, account_login
	FROM chat_messages
	LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_messages.message_user
	WHERE message_time >= :time
	ORDER BY message_time ASC LIMIT 0,100
");
$query->execute(array(
	'time' => $_GET['dateConnexion']
));
$count = $query->rowCount();
if($count != 0) {
	$json['messages'] = '<div id="messages_content">';


	$json['messages'] .= '<table><tr><td style="height:500px;" valign="bottom">';
	$json['messages'] .= '<table style="width:100%">';

	$i = 1;
	$e = 0;
	$prev = 0;
	$text = null;
	while ($data = $query->fetch()) {
		if($i != 1) {
			$idNew = $data['message_user'];		
			if($idNew != $id) {
				if($colId == 1) {
					$color = '#077692';
					$colId = 0;
				} else {
					$color = '#666';
					$colId = 1;
				}
				$id = $idNew;
			} else
				$color = $color;
		} else {
			$color = '#666';
			$id = $data['message_user'];
			$colId = 1;
		}


		$text .= '<tr><td style="width:15%" valign="top">';
		if($prev != $data['account_id']) {
			$text .= '<a href="#post" onclick="insertLogin(\''.addslashes($data['account_login']).'\')" style="color:black">';
			$text .= date('[H:i]', $data['message_time']);
			$text .= '&nbsp;<span style="color:'.$color.'">'.$data['account_login'].'</span>';
			$text .= '</a>';	
		}
		$text .= '</td>';			
		$text .= '<td style="width:85%;padding-left:10px;" valign="top">';


		$message = htmlspecialchars($data['message_text']); 

		$message = urllink($message);
			
		if(user_verified()){
			if(preg_match('#'.$_SESSION['login'].'&gt;#is', $message)) {
				$message = preg_replace('#'.$_SESSION['login'].'&gt;#is', '<b><span style="color:orange;">'.$_SESSION['login'].'&gt;</span></b>', $message);
			}
		}
			
		$text .= $message.'<br />';
		$text .= '</td></tr>';

		$i++;
		$prev = $data['account_id'];
	}
		
	$json['messages'] = $text;

	$json['messages'] .= '</table>';
	$json['messages'] .= '</td></tr></table>';
	$json['messages'] .= '</div>';			
} else {
	$json['messages'] = 'Ecrivez un message !';
}
$query->closeCursor();
echo json_encode($json);
?>