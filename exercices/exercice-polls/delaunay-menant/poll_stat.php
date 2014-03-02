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

                header('Location:membre.php');
                
            }
            else{

                $req_poll = $pdo->prepare('SELECT * FROM poll WHERE id = ?');
                $req_poll->execute(array($_GET['sondage']));

                $data_poll = $req_poll->fetch();
                echo '<h1 class="bigger poll">'.utf8_encode($data_poll['name']).'</h1>';

                     echo '<ul class="poll-list" style="padding-top:200px">';

                    $req_question = $pdo->prepare('SELECT * FROM questions WHERE id_poll = ?');
                    $req_question->execute(array($_GET['sondage']));
                    $nb_rows = $req_question->rowCount();

                    if($nb_rows > 0){
                        while($data_question = $req_question->fetch()){
                            $suivant = $data_question['numero']+1;
                            echo '<li>';
                            echo '<span class="title">'.utf8_encode(stripslashes($data_question['name'])).'</span><ul>';

                            $req_answers = $pdo->prepare('SELECT * FROM answers WHERE id_question = ? AND id_poll = ?');
                            $req_answers->execute(array($data_question['id'], $_GET['sondage']));

                            $req_valid_question = $pdo->prepare('SELECT * FROM valid WHERE id_question = ? AND id_poll = ?');
                            $req_valid_question->execute(array($data_question['numero'], $_GET['sondage']));
                            $nb_valid_question = $req_valid_question->rowCount();
                            
                            while($data_answers = $req_answers->fetch()){

                                $req_valid_answer = $pdo->prepare('SELECT * FROM valid WHERE id_question = ? AND id_answer = ? AND id_poll = ?');
                                $req_valid_answer->execute(array($data_question['numero'], $data_answers['numero'], $_GET['sondage']));
                                $nb_valid_answer = $req_valid_answer->rowCount();

                                $percentage = ($nb_valid_answer/$nb_valid_question)*100;

                                echo '<li>'.utf8_encode(stripslashes($data_answers['name'])).' : '.$percentage.'%</li>';
                            }
                            echo '</ul>
                            </li>';

                        }
                        echo '</ul>';
                        echo '<a class="btn" href="membre.php">Retour</a>';

                        }
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