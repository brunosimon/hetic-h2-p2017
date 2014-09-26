<?php
	if(!empty($_POST)) {
		$to      = 'younadoh@gmail.com';
	    $subject = 'Formulaire de contact - SNIPPET';
	    $message = $_POST['message'];
	    $headers = 'From: '.$_POST['mail'] . "\r\n" .
	    'Reply-To: '.$_POST['mail'] . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();

	    mail($to, $subject, $message, $headers);
	}
 ?>