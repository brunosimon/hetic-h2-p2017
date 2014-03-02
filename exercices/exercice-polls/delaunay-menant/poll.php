<?php 

    session_start();
    //$document = basename(__FILE__);
    $titre = "Sondage";

    include("head.php");

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){

    	if (!empty($_GET['sondage'])){
            require_once 'config.inc.php';
            $req = $pdo->prepare('SELECT * FROM valid WHERE id_poll = ? AND id_user = ?');
            $req->execute(array($_GET['sondage'], $_SESSION['id']));
            $nb_rows = $req->rowCount();
            
            if($nb_rows == 0){

                if (!empty($_POST['poll_valid'])){
                    $req = $pdo->prepare('SELECT * FROM questions WHERE id_poll = ?');
                    $req->execute(array($_GET['sondage']));
                    $nb_rows = $req->rowCount();

                    $error = false;
                    $errors = array();

                    while($data = $req->fetch()){

                        if (isset($_POST['q'.$data['numero']]) && !empty($_POST['q'.$data['numero']])){
                                $_POST['q'.$data['numero']] = (int)$_POST['q'.$data['numero']];

                            if ($_POST['q'.$data['numero']] == 0){
                                $errors['data'] = 'Erreur : Les données envoyées ne sont pas conformes !<br />';
                                $error = true;
                            }
                            if ($_POST['q'.$data['numero']] > $nb_rows || $_POST['q'.$data['numero']] < 1){
                                $errors['data'] = 'Erreur : Les données envoyées ne sont pas conformes !<br />';
                                $error = true;
                            }
                        }
                        else{
                            $errors['empty'] = 'Erreur : Vous n\'avez pas rempli tous les champs !<br />';
                            $error = true;
                        }   
                    }

                    if ($error == false){
                        echo '<h1 class="bigger" style="padding-top:100px">Valider le sondage</h1>';
                        echo '<article class="success">Le sondage a bien été validé !';
                        echo '<br />Cliquez <a href="index.php">ici</a> pour revenir à l\'accueil.</article>';
                        for ($i = 1;$i <= $nb_rows; $i++){                            
                            $req = 'INSERT INTO valid (id_poll,id_question,id_answer,id_user) VALUES (:id_poll, :id_question, :id_answer, :id_user)';
                            $insert = $pdo->prepare($req);
                            $insert->execute(array('id_poll' => $_GET['sondage'], 'id_question' => $i, 'id_answer' => $_POST['q'.$i], 'id_user' => $_SESSION['id']));
                        }

                    }
                    else{
                        echo '<h1 class="bigger" style="padding-top:100px">Valider le sondage</h1>';
                        if (isset($errors['data'])) echo '<article class="errors">'.$errors['data'];
                        if (isset($errors['empty'])) echo '<article class="errors">'.$errors['empty'];

                        echo '<a href="javascript:history.back()">Revenir en arrière.</a></article>';
                    }

                }
                else{
                    
                    $req_poll = $pdo->prepare('SELECT * FROM poll WHERE id = ?');
                    $req_poll->execute(array($_GET['sondage']));
                    $data_poll = $req_poll->fetch();

                    echo '<h1 class="bigger poll">'.utf8_encode($data_poll['name']).'</h1>
                            <ul class="poll-list">
                            <form action="#" method="POST">';

                    $req_question = $pdo->prepare('SELECT * FROM questions WHERE id_poll = ?');
                    $req_question->execute(array($_GET['sondage']));
                    $nb_rows = $req_question->rowCount();

                    if($nb_rows > 0){
                        while($data_question = $req_question->fetch()){
                            $suivant = $data_question['numero']+1;
                            echo '<li class="question" id ="l'.$data_question['numero'].'">';
                            echo '<span class="title">'.utf8_encode(stripslashes($data_question['name'])).'</span><ul>';
                            $req_answers = $pdo->prepare('SELECT * FROM answers WHERE id_question = ? AND id_poll = ?');
                            $req_answers->execute(array($data_question['id'], $_GET['sondage']));
                            
                            while($data_answers = $req_answers->fetch()){
                                echo '<li><input type="radio" name="q'.$data_question['numero'].'" id="q'.$data_question['numero'].'_'.$data_answers['numero'].'" value="'.$data_answers['numero'].'"><label for="q'.$data_question['numero'].'_'.$data_answers['numero'].'">'.utf8_encode(stripslashes($data_answers['name'])).'</label></li>';
                            }
                            echo '</ul>';
                            echo '<a class="btn" href="#l'.$suivant.'">Question suivante</a>
                            </li>';

                        }
                        echo '</ul>';
                        $end = $nb_rows+1;
                        echo '<ul class="end-list">
                            <li class="question" id="l'.$end.'">
                                    <h4 style="text-align:center;">Merci !</h4>
                                    <h6 style="text-align:center; font-weight:normal; margin:12px 0 30px 0;">Cliquez sur valider terminer le sondage.</h6>
                            </li>
                        
                            <input class="btn valid" type="submit" name="poll_valid" value="Valider" /> 
                            </form>
                        </ul>';
                    }
                    else{
                        header('Location:membre.php');
                    }
                }
            }
            else{
                header('Location:membre.php');
            }
        }
        else{
            header('Location:membre.php');
        }

	}
	else{
		header('Location:index.php');
	}

    //echo '<footer class="foot">&copy; Projet Développement Web - PHP / MySQL</footer>';

    echo'<script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/jquery.scrollTo.js"></script>
    <script type="text/javascript" src="js/bootstrap-jquery.js"></script>';

    include("footer.php"); 

?>