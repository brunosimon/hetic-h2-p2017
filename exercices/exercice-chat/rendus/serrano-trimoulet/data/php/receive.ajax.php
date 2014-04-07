<?php
	include('config.php');
	$select = $pdo->query('SELECT * FROM messages ORDER BY id DESC');
	$affichage_messages = $select->fetchAll();

	foreach ($affichage_messages as $value) {
		echo '
		<div class="message">
			<span class="author">'.$value['author'].'</span>
			<span class="text">'.$value['text'].'</span>
			<span class="date">'.$value['date'].'</span>
		</div>';
	}
?>
