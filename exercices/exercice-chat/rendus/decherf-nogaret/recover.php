<?php
	require_once 'connect.php';
	session_start();

	$query = $pdo->query("SELECT * FROM messages");
	$entres = $query->fetchALL();
?>

<?php foreach ($entres as $_entres): ?>
	<tr>
		<td><strong><?php echo $_entres['pseudo'] ?> :</strong></td>
		<td><?php echo $_entres['message'] ?></td>
	</tr></br>
<?php endforeach; ?>