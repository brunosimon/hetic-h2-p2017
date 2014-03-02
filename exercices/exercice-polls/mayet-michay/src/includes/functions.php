<?php 

/* -------------------------------------------------------------------------------------------------------- */
/* ----------------------------------------------- FUNCTIONS ---------------------------------------------- */
/* -------------------------------------------------------------------------------------------------------- */


/* 
* Add the answer of the user to the database
* @param string $token -- token of the user who is answering
* @param int $id_answer -- id of the answer
*/
function add_user_answer($token,$id_answer) {
    require 'database.php';
    try {
    $query = $pdo->prepare('
        INSERT INTO user_answers (token_user, id_answer) 
        VALUES (:token,:id_answer)
                           ');
    $query->bindParam(':token', $token, PDO::PARAM_STR, 16);
    $query->bindParam(':id_answer', $id_answer, PDO::PARAM_INT);
    $query->execute();
    }
    catch (Exception $e) {
        echo "Data could not be retrieved from the database.";
        exit;
    }
}

/*
* Check if the id of the answer goes with the question
* @param int $step -- number of the step
* @param int $id_answer -- id of the answer
* return a boolean
*/
function check_answer($id_answer,$step) {
    require 'database.php';
    $query = $pdo->prepare('SELECT id_question FROM answers WHERE id_answer= :id_answer');
    $query->bindParam(':id_answer', $id_answer, PDO::PARAM_INT);
    $query->execute();
    $answer = $query->fetch();
    
    if($answer->id_question != $step || empty($answer)){
        return false;
    }
    return true;
}

/* 
* Returns the number of questions (steps) 
* return int -- number of questions
*/
function get_steps() {
    require 'database.php';
    $query =$pdo->query('SELECT COUNT(*) AS nb FROM questions');
    $answer = $query->fetch();
    return $answer->nb;
}

/* 
* Returns the different answers for a question
* @param int $step -- the current step 
* return array -- the different answers, their value and their ids.
*/
function get_answers($step) {
    require 'database.php';
    $query = $pdo->prepare('SELECT * FROM answers WHERE id_question= :step ORDER BY RAND()');
    $query->bindParam(':step', $step, PDO::PARAM_INT);
    $query->execute();
    $answers = $query->fetchAll();
    return $answers;
}

/* 
* Returns the different questions for the current step
* @param int $step -- the current step 
* return string -- the question
*/
function get_question($step){
    require 'database.php';
    $query  =$pdo->prepare('SELECT * FROM questions WHERE ordre = :step');
    $query->bindParam(':step', $step, PDO::PARAM_INT);
    $query->execute();
    $result = $query->fetch();
    return $result->text;
}

/* 
* Returns a random string composed by alphanumerical characters
* @param int $length -- the length of the string
* return string -- the string
*/
function generate_random_string($length = 16) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $random_string = '';
    for($i = 0; $i < $length; $i++) {
        $random_string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $random_string;
}


/*
* Returns a sorted array from the votes 
* @param string $token -- the token of the user
* return array -- A sorted Array with the results of the quizz
*/
function retrieve_results($token) {
    require 'database.php';        
    $profiles = retrieve_profiles();
    $rank = Array();
    foreach($profiles as $profile) {
    	$query = $pdo->prepare('
			SELECT COUNT(answ.id_answer)
			AS value
			FROM user_answers ua
			INNER JOIN answers answ ON ua.id_answer = answ.id_answer
			WHERE token_user = :token AND answ.value = :value');
		$query->bindParam(':token', $token, PDO::PARAM_STR, 16);
		$query->bindParam(':value', $profile->id_profile, PDO::PARAM_INT);
		$query->execute();
    	$result = $query->fetch();
    	$rank[$profile->id_profile] = $result->value;
    }
    arsort($rank);
    return $rank;
}

/*
* Returns an array with all the profiles
* return array -- An array with the id and name of all the profiles
*/
function retrieve_profiles() {
    require 'database.php';
    $query = $pdo->query('SELECT id_profile, name, description, img FROM profiles');
    $profiles = $query->fetchAll();
    return $profiles;
}

/*
* Returns the informations of the profile
* @param : int $id -- The id of the hero
* return array -- The description, the name and the picture of the profile
*/
function get_informations($id) {
	require 'database.php';
	$query = $pdo->prepare('
		SELECT name, description, img
		FROM profiles
		WHERE id_profile = :id');
	$query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->execute();
	$result = $query->fetch();
	return $result;
}

/* 
* Add to the table 'result' your character
* @param int $id -- the id of the hero
*/
function add_to_result_list($id,$token) {
	require 'database.php';
	$query = $pdo->prepare('
		INSERT INTO results (id_profile, date, token) 
        VALUES (:id, NOW(),:token)');
	$query->bindParam(':id', $id, PDO::PARAM_INT);
	$query->bindParam(':token', $token, PDO::PARAM_STR,16);
	$query->execute();
}


/* 
* Calculate the percent of each profile in the database
* return array with name->percent
*/
function get_percents_results() {
	require 'database.php';
	$profiles = retrieve_profiles();
	$percents = Array();
	$query = $pdo->query('
			SELECT COUNT(id_result)
			AS profiles
			FROM results');
	$number_result = $query->fetch()->profiles;
	foreach($profiles as $profile) {
		$query = $pdo->prepare('
			SELECT COUNT(id_result)
			AS number
			FROM results
			WHERE id_profile = :id_profile');
		$query->bindParam(':id_profile', $profile->id_profile, PDO::PARAM_INT);
		$query->execute();
		$result = $query->fetch();
		$percents[$profile->name] = round(($result->number/$number_result)*100);
	}

	return $percents;
}