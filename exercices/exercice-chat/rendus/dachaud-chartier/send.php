<?php 
session_start();
require_once 'config.php'; 

header('Content-Type: text/html; charset=utf-8');

$accent = array('à','á','â','ã','ä','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ú','û','ü','ý','ÿ','À','Á','Â','Ã','Ä','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ú','Û','Ü','Ý');
$sans_accent = array('a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','u','y','y','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','U','U','U','U','Y');

// Test s'il y a des données envoyée en POST
if(!empty($_POST))
{
	$id = $_SESSION['id'];

    $result = $pdo->query('SELECT * FROM quizz WHERE etat = 1 ORDER BY id DESC LIMIT 1');
    $quiz = $result->fetch();

    if($quiz['question_id'] != 0){
    	$result = $pdo->query("SELECT * FROM questions WHERE id = '".$quiz['question_id']."' LIMIT 1");
        $question = $result->fetch();

        $reponses = array();

        for($i = 1; $i <= 6; $i++){
            if ($question['answer_'.$i] != ''){
                $reponses[$i - 1] = strtolower(preg_replace('/[^[:alnum:]]/', '', str_replace($accent,$sans_accent,utf8_encode(stripslashes($question['answer_'.$i])))));
            }
        }
    }

    $message = $_POST['message'];
    $message = strtolower(preg_replace('/[^[:alnum:]]/', '', str_replace($accent,$sans_accent,$message)));

    $result = $pdo->query("SELECT * FROM users WHERE id = '".$id."' LIMIT 1");
    $user = $result->fetch();

    if (isset($user['id'])){
    	if ($user['ban'] == 0){
    		$result = $pdo->exec("INSERT INTO messages (message,user_id) VALUES ('".addslashes(utf8_decode($_POST['message']))."','".$id."')");
    	}
    }

    if($quiz['question_id'] != 0){
        if (in_array($message, $reponses)){
            $result = $pdo->exec("INSERT INTO messages (message,user_id,param1,param2) VALUES ('".$user['login']." (+".$quiz['timeleft']."pts)','1','win','".utf8_encode(addslashes($question['answer_1']))."')");

            $result = $pdo->query('SELECT * FROM scores WHERE user_id = '.$_SESSION['id'].' AND quiz_id = '.$quiz['id'].' ORDER BY id DESC LIMIT 1');
            $res = $result->fetch();

            $result = $pdo->exec("UPDATE users SET points = '".($user['points'] + $quiz['timeleft'])."' WHERE id = '".$id."'");

            $result = $pdo->exec("UPDATE scores SET score = '".($res['score'] + $quiz['timeleft'])."', prev_score = '".$res['score']."' WHERE id = '".$res['id']."'");

            $result = $pdo->exec("UPDATE quizz SET question_id = '0', timeleft = '15' WHERE id = '".$quiz['id']."'");
        }
    }

    die('message : '.$_POST['message']);
}