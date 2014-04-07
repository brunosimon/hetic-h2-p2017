<?php
        session_start();
        require_once 'config.php'; 

        header('Content-Type: text/html; charset=utf-8');

         $timeleft = 0;
         $mes_kestion = '';
         $num_kestion = 0;
        //INITIALISATION DU QUIZ
        //Verification de l'existence d'un quiz
        $result = $pdo->query('SELECT * FROM quizz WHERE etat = 1 ORDER BY id DESC LIMIT 1');
        $quiz = $result->fetch();

        if(isset($quiz['id'])){
            //Verification de la présence dans scores
            $result = $pdo->query('SELECT * FROM scores WHERE user_id = '.$_SESSION['id'].' AND quiz_id = '.$quiz['id'].' ORDER BY id DESC LIMIT 1');
            $res = $result->fetch();

            if(isset($res['id'])){

            } else {
                //Recherche de son pseudo
                $resultuser = $pdo->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
                $user = $resultuser->fetch();

                //Création du score
                $result = $pdo->exec("INSERT INTO scores (user_id,login,quiz_id,score,prev_score) VALUES ('".$user['id']."','".$user['login']."','".$quiz['id']."','0','0')");
            }

            $timeleft = $quiz['timeleft'];
            //INITIALISATION DE LA QUESTION
            if($quiz['timeleft']<=0){
                if($quiz['question_id'] == 0){
                    if($quiz['question_num'] >= 10){
                        $result = $pdo->exec("UPDATE quizz SET etat = '0' WHERE id = '".$quiz['id']."'");
                    } else {    
                        //if (CHANGING_QUESTION == 0){
                            //define('CHANGING_QUESTION','1');           
                            $res = $pdo->query('select count(*) as nb from questions');
                            $data = $res->fetch();
                            $nb = $data['nb'];

                            $nb = mt_rand(1, $nb);

                            $result = $pdo->exec("UPDATE quizz SET question_num = '".($quiz['question_num'] + 1)."', question_id = '".$nb."', timeleft = '15' WHERE id = '".$quiz['id']."'");
                            $timeleft = 15;

                            $resultkest = $pdo->query("SELECT * FROM questions WHERE id = '".$nb."' ORDER BY id DESC LIMIT 1");
                            $kestion = $resultkest->fetch();

                            $mes_kestion = utf8_encode($kestion['question']);
                            $num_kestion = $quiz['question_num'] + 1;

                            $result = $pdo->exec("INSERT INTO messages (message,user_id,param1,param2) VALUES ('".utf8_decode(addslashes($mes_kestion))."','1','new_kest','".$num_kestion."')");
                            //define('CHANGING_QUESTION','0'); 
                        //} 
                    }
                } else {
                    $resultkest = $pdo->query("SELECT * FROM questions WHERE id = '".$quiz['question_id']."' ORDER BY id DESC LIMIT 1");
                    $kestion = $resultkest->fetch();

                    $result = $pdo->exec("INSERT INTO messages (message,user_id,param1,param2) VALUES ('','1','time_up','".utf8_encode(addslashes($kestion['answer_1']))."')");

                    $result = $pdo->exec("UPDATE quizz SET question_id = '0', timeleft = '15' WHERE id = '".$quiz['id']."'");
                    $timeleft = 15;

                }
            } else {
                //Recherche de la question
                $resultkest = $pdo->query("SELECT * FROM questions WHERE id = '".$quiz['question_id']."' ORDER BY id DESC LIMIT 1");
                $kestion = $resultkest->fetch();

                $mes_kestion = utf8_encode($kestion['question']);
                $num_kestion = $quiz['question_num'];

                if($quiz['question_id'] == 0){
                    $num_kestion = 0;
                }

                if(strtotime($quiz['lastcheck']) < time()){
                    $result = $pdo->exec("UPDATE quizz SET timeleft = ".($quiz['timeleft'] - 1).", lastcheck = '".date("Y-m-d H:i:s")."' WHERE id = '".$quiz['id']."'"); //date("Y-m-d H:i:s")
                    $timeleft = $quiz['timeleft'] - 1;
                }

                if(($quiz['question_num'] == 10)&&($quiz['question_id'] == 0)){
                    if($quiz['mes_fin'] == 0){
                        $result = $pdo->query('SELECT * FROM scores WHERE quiz_id = '.$quiz['id'].' ORDER BY score DESC LIMIT 1');
                        $res = $result->fetch();

                        $result = $pdo->exec("INSERT INTO messages (message,user_id,param1,param2) VALUES ('".addslashes($res['login'])."','1','end','".$res['score']."')");

                         $result = $pdo->exec("UPDATE quizz SET mes_fin = '1' WHERE id = '".$quiz['id']."'");
                    }
                }
            }


        } else {
            //Création du quiz
            $result = $pdo->exec("INSERT INTO quizz (question_num,question_id,etat,timeleft,lastcheck) VALUES ('0','0','1','15','".date("Y-m-d H:i:s")."')");

            //Récuperation du quiz
            $result = $pdo->query('SELECT * FROM quizz WHERE etat = 1 ORDER BY id DESC LIMIT 1');
            $quiz = $result->fetch();

            //Recherche de son pseudo
            $resultuser = $pdo->query("SELECT * FROM users WHERE id = '".$_SESSION['id']."' ORDER BY id DESC LIMIT 1");
            $user = $resultuser->fetch();

            //Création du score
            $result = $pdo->exec("INSERT INTO scores (user_id,login,quiz_id,score,prev_score) VALUES ('".$user['id']."','".$user['login']."','".$quiz['id']."','0','0')");
        }

        //RECUPERATION DES SCORES
        $result = $pdo->query('SELECT * FROM scores WHERE quiz_id = '.$quiz['id'].' ORDER BY score DESC');

        $scores = array();
        $i = 0;

        while($res = $result->fetch()){

            $scores[$i] =   array(
                                                'pseudo'  => $res['login'],
                                                'id'    => $res['user_id'],
                                                'score' => $res['score'],
                                                'prev_score' => $res['prev_score']
                                            );

            $i++;
        }

        $messages = array();

        $result = $pdo->query('SELECT * FROM messages ORDER BY id DESC LIMIT 20');
        $i = 0;

        while($mes = $result->fetch()){
            $result2 = $pdo->query("SELECT * FROM users WHERE id = '".$mes['user_id']."' LIMIT 1");
            $user = $result2->fetch();

            if (isset($user['id'])){
                if ($user['ban'] == '0'){
                    $messages[$i] =   array(
                                                        'pseudo'  => $user['login'],
                                                        'id'      => $user['id'],
                                                        'date'    => date("H:m:s", strtotime($mes['date'])),
                                                        'message' => htmlspecialchars(utf8_encode(stripslashes($mes['message']))),
                                                        'param1'  => $mes['param1'],
                                                        'param2'  => $mes['param2']
                                                    );
                } else {
                    $messages[$i] =   array(
                                                        'pseudo'  => $user['login'],
                                                        'date'    => date("H:m:s", strtotime($mes['date'])),
                                                        'message' => "UTILISATEUR BANNI"
                                                    );
                    }
            } else {
                $messages[$i] =   array(
                                                        'pseudo'  => $user['login'],
                                                        'date'    => date("H:m:s", strtotime($mes['date'])),
                                                        'message' => "UTILISATEUR BANNI"
                                                    );
            }
            $i++;
        }
    // Message statiques
    // Il faudra par la suite que les messages viennent de la base de données

    //$result = $pdo->query('SELECT * FROM scores WHERE id = 6 LIMIT 1');
    //$quizz = $result->fetch();
    //$players = unserialize($quizz['scores']);

    // Variable qui sera renvoyée encodée en JSON (objet)
    $return = array(
        'messages' => array_reverse($messages),
        'timeleft' => $timeleft,
        'num_kestion' => $num_kestion,
        'mes_kestion' => $mes_kestion,
        'scores' => $scores
        );


    // La fonction json_encode va convertir notre tableau en objet qui sera directement interprété comme tel par notre JS
    die(json_encode($return));