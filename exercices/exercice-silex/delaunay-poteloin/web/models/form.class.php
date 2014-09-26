<?php

	class FormModel{
		function __construct($pdo){
			$this->pdo = $pdo;
		}

		function create_form_contact($request, $app){

		$data_form = array(
			'name' => 'Your name',
			'email' => 'Your email',
			'subject' => 'Mail subject',
			'text_mail' => '',
			'placeholder_text' => 'Message'
		);

		$form = $app['form.factory']->createBuilder('form', $data_form)
		    ->add('name')
		    ->add('email')
		    ->add('subject')
		    ->add('text_mail', 'textarea', array('attr' => array('rows' => '7','cols' => '10')) )
		    ->getForm();

		$form->handleRequest($request);

		$form_return = array(
			'data_form' => $data_form,
			'form' => $form
		);

		return $form_return;

		}	

		function add_mail_db($date, $from_adress,$from_name,$subject,$message){
			$prepare = $this->pdo->prepare('
				INSERT INTO
					mails (date, from_adress, from_name, subject, message)
				VALUES
					(:date, :from_adress, :from_name, :subject, :message)
			');

			$prepare->execute(array(
				':date'=>$date, 
				':from_adress'=>$from_adress, 
				':from_name'=>utf8_decode($from_name), 
				':subject'=>utf8_decode($subject), 
				':message'=>utf8_decode($message)
			));
		}

		function send_mail($subject, $from_adress, $from_name, $to, $message){
			if (!empty($from_name) && !empty($from_adress) && !empty($subject) && !empty($message)){

				if (filter_var($from_adress, FILTER_VALIDATE_EMAIL)){
					$name = strip_tags(trim($from_name));
					$mail = strip_tags(trim($from_adress));
					$subject = strip_tags(trim($subject));
					$text = strip_tags(trim($message));
					$message_text = $message;

					$adress = "clem.delaunay@gmail.com";
					$saut_ligne = "\n";
								 
					//Boundary
					$boundary = "-----=".md5(rand());
					 
					//Message Subject
					$subject = "".$subject."";

					$header = "From: \"".$name."\"<".$mail.">".$saut_ligne;
					$header .= "Reply-to: \"".$name."\" <".$mail.">".$saut_ligne;
					$header .= "MIME-Version: 1.0".$saut_ligne;
					$header .= "Content-Type: multipart/alternative;".$saut_ligne." boundary=\"$boundary\"".$saut_ligne;


					//Boundary 
					$message= $saut_ligne."--".$boundary.$saut_ligne;
					 
					//Message
					$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".$saut_ligne;
					$message.= "Content-Transfer-Encoding: 8bit".$saut_ligne;
					$message.= $saut_ligne.$text.$saut_ligne;


					//Boundary 
					$message.= $saut_ligne."--".$boundary."--".$saut_ligne;
					$message.= $saut_ligne."--".$boundary."--".$saut_ligne;

					mail($to,$subject,$message,$header);
					$this->add_mail_db(date("Y-m-d h:i:s"), $from_adress,$from_name,$subject,$message_text);

					return 'email_sent';
				}
				else
					return 'wrong_email';
			}
			else
				return 'fields_empty';
		}
	}

?>