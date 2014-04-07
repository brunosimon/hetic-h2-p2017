<?php
	include('config.php');

	$select = $pdo->query("SELECT * FROM messages ORDER BY id DESC");

	while($value = $select->fetch()){

		// Smiley
		foreach ($smiley as $key => $value_2) {
			$value['message'] = str_replace($key, '<img src="assets/images/smileys/'.$value_2.'.png"/>', $value['message']);
		}

		// Color for Own message
		if($_SESSION['login'] == $value['name']){
			echo '
			<div class="message">
	          <ul>
	            <li><font color="#2980b9">'.$value['name'].' :</font></li>
	            <li title="'.$value['date'].'">'.$value['message'].'</li>
	          </ul>
	        </div>';
		}
		else{
			echo '
			<div class="message">
	          <ul>
	            <li>'.$value['name'].' :</li>
	            <li title="'.$value['date'].'">'.$value['message'].'</li>
	          </ul>
	        </div>';
		}
	}
?>