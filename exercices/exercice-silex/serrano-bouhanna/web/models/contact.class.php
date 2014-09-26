<?php

/**
* CONTACT
*/
class Contact_Model {

	function send($form){
		$to      = 'webmaster@snippets.com';
		$subject = $form['subject'];
		$message = 'Message send by '.$form['name'].'<br/>';
		$message .= 'Email sender '.$form['to'].'<br/>';
		$message .= 'Message '.$form['message'].'<br/>';
		$headers = 'From: webmaster@snippets.com' . "\r\n" .
		'Reply-To: '.$form['to'].'' . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

		$send = mail($to, $subject, $message, $headers);

		if($send){
			return true;
		}
		else{
			return false;
		}
	}
}