<?php 
	session_start();
	require 'config.php';


	//Select all users in DB
	$ban_list = $pdo->prepare('SELECT * FROM users ORDER BY login');
	$ban_list->execute();
	$ban = $ban_list->fetchAll();
	
	//Change password of banned id
	if(!empty($_POST)){
		$toban = $pdo->prepare('UPDATE users SET password = "bannedForLife!@!" WHERE id = :id');
		$toban->bindValue(':id', $_POST['ban']);
		$toban->execute();

	}


?>




<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ban</title>
	<link rel="stylesheet" type="text/css" href="../../src/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="../../src/css/style.css">
</head>
<body>
	<!-- Ban form -->
	<form action="#" method="POST">
		<label for="ban" id="ban">Choose id to ban</label>
		<input type="text" class="banInput" name="ban" id="ban">
		<input type="submit">
	</form>
	<a href="chat.php">Back to chat page</a>
	<?php echo '<pre>';
	print_r($ban);
	echo '</pre>'; ?>
</body>
</html>