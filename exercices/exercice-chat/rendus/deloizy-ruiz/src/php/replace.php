<?php


	$message = $_POST['themessage'];

	$message = str_replace(':)', '<img src=../images/smileys/smile.png', $message);
	$message = str_replace(':D', '<img src=../images/smileys/laugh.png', $message);
	$message = str_replace(';)', '<img src=../images/smileys/eye.png', $message);
	$message = str_replace(':P', '<img src=../images/smileys/tong.png', $message);
	$message = str_replace(':*', '<img src=../images/smileys/kiss.png', $message);
	$message = str_replace(':(', '<img src=../images/smileys/bad.png', $message);
	$message = str_replace(':O', '<img src=../images/smileys/afraid.png', $message);
	$message = str_replace(':((', '<img src=../images/smileys/cry.png', $message);
	$message = str_replace('<3', '<img src=../images/smileys/heart.png', $message);


	echo $message;

?>