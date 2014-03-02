<?php

class Questionnaire{

	public function insert($post){
		extract($post);
		$ip = $_SERVER['REMOTE_ADDR'];

		$verification = DATABASE::DB()->prepare("SELECT * FROM result WHERE ip = :id");
		$verification->bindvalue(':id', $ip, PDO::PARAM_STR);
		$verification->execute();
		$correspondance = $verification->fetch();

		if (!$correspondance){
			$query = "
			INSERT INTO result (
			ip,question_1, question_2, question_3, question_4, question_5, question_6, 
			question_7, question_8, question_9, question_10_1, question_10_2, question_10_3, 
			question_11, question_12) 
			VALUES (
			:ip,:question_1, :question_2, :question_3, :question_4, :question_5, :question_6, 
			:question_7, :question_8, :question_9, :question_10_1, :question_10_2, :question_10_3, 
			:question_11, :question_12)";
			
			$insert = DATABASE::DB()->prepare($query);
			$insert->bindvalue(':ip', $ip, PDO::PARAM_STR);
			$insert->bindvalue(':question_1', $question_1, PDO::PARAM_STR);
			$insert->bindvalue(':question_2', $question_2, PDO::PARAM_STR);
			$insert->bindvalue(':question_3', $question_3, PDO::PARAM_STR);
			$insert->bindvalue(':question_4', $question_4, PDO::PARAM_STR);
			$insert->bindvalue(':question_5', $question_5, PDO::PARAM_STR);
			$insert->bindvalue(':question_6', $question_6, PDO::PARAM_STR);
			$insert->bindvalue(':question_7', $question_7, PDO::PARAM_STR);
			$insert->bindvalue(':question_8', $question_8, PDO::PARAM_STR);
			$insert->bindvalue(':question_9', $question_9, PDO::PARAM_STR);
			$insert->bindvalue(':question_10_1', $question_10_1, PDO::PARAM_STR);
			$insert->bindvalue(':question_10_2', $question_10_2, PDO::PARAM_STR);
			$insert->bindvalue(':question_10_3', $question_10_3, PDO::PARAM_STR);
			$insert->bindvalue(':question_11', $question_11, PDO::PARAM_STR);
			$insert->bindvalue(':question_12', $question_12, PDO::PARAM_STR);
			$insert->execute();
			return $info = "GOOD";
		}
		else{
			return $info = "ERROR_IP";
		}
	}
}

?>
