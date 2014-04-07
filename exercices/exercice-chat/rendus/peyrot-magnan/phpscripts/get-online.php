<?php
session_start();
include('functions.php');
$db = db_connect();

$query = $db->prepare("
	SELECT *
	FROM chat_online
	WHERE online_user = :user 
");
$query->execute(array(
	'user' => $_SESSION['id']
));

$count = $query->rowCount();
$data = $query->fetch();

if(user_verified()) {
	if($count == 0) {
		$insert = $db->prepare('
			INSERT INTO chat_online (online_id, online_ip, online_user, online_status, online_time) 
			VALUES(:id, :ip, :user, :status, :time)
		');
		$insert->execute(array(
			'id' => '',
			'ip' => $_SERVER["REMOTE_ADDR"],
			'user' => $_SESSION['id'],
			'status' => '2',
			'time' => time()
		));
	} else {
		$update = $db->prepare('UPDATE chat_online SET online_time = :time WHERE online_user = :user');
		$update->execute(array(
			'time' => time(),
			'user' => $_SESSION['id']
		));
	}
}

$query->closeCursor();

$time_out = time()-5;
$delete = $db->prepare('DELETE FROM chat_online WHERE online_time < :time');
$delete->execute(array(
	'time' => $time_out
));

$query = $db->prepare("
	SELECT online_id, online_id, online_user, online_status, online_time, account_id, account_login
	FROM chat_online 
	LEFT JOIN chat_accounts ON chat_accounts.account_id = chat_online.online_user 
	ORDER BY account_login
");
$query->execute();
$count = $query->rowCount();


if($count != 0) {
	$json['error'] = '0';
	
	$i = 0;
	while($data = $query->fetch()) {
		if($data['online_status'] == '0') {
			$status = 'inactive';
		} elseif($data['online_status'] == '1') {
			$status = 'busy';
		} elseif($data['online_status'] == '2') {
			$status = 'active';
		}
		
		$infos["status"] = $status;

		$infos["login"] = $data['account_login'];
		
		$accounts[$i] = $infos;
		$i++;
	}

	$json['list'] = $accounts;
} else {

	$json['error'] = '1';
}

$query->closeCursor();

echo json_encode($json);

?>