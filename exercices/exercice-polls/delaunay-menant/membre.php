<?php 

    session_start();
    //$document = basename(__FILE__);
    $titre = "Espace membre";

    include("head.php");

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){

        require_once 'config.inc.php';
        $req_done = 'SELECT p.name poll_name, p.id poll_id FROM poll p INNER JOIN valid v ON v.id_poll = p.id WHERE v.id_user = ? AND valid = 1 GROUP BY id_poll';
        $req_done = $pdo->prepare($req_done);
        $req_done->execute(array($_SESSION['id']));
        $nb_rows_done = $req_done->rowCount();

        $poll_valid_name = array();
        $poll_valid_id = array();

        while ($data_done = $req_done->fetch()){
            array_push($poll_valid_name, $data_done['poll_name']);
            array_push($poll_valid_id, $data_done['poll_id']);
        }

        if ($nb_rows_done == 0){
        	$poll_valid = 0;
        }
        else{
        	$poll_valid = implode(",", $poll_valid_id);
        }
        

        $req_todo = 'SELECT * FROM poll WHERE valid = 1 AND id NOT IN ('.$poll_valid.')';
        $req_todo = $pdo->query($req_todo);	

        echo '<section class="todo-contain">
		<h3>Sondages à faire</h3>
		<h2 class="fatter">Cliquez sur un sondage pour le commencer</h2><br />
		<ul class="todo-list">';

		$done = false;

		while ($data_todo = $req_todo->fetch()){
			if (strlen ($data_todo['name']) > 16) $space = '...';
	        else $space = '';
			echo '<li class="poll">
				<a href="poll.php?sondage='.$data_todo['id'].'">
				<figure></figure>
				<article>'.utf8_encode(substr($data_todo['name'], 0, 16)).$space.'...</a></article>
			</li>';

			$done = true;

    	}

    	if($done == false){
    		echo '<li class="poll">Vous avez effectué tous les sondages !</li>';
    	}
             
        echo '</ul></section>';

         echo '<section class="done-contain">
         <h3>Sondages terminés</h3>
		 <h2 class="fatter">Cliquez sur un sondage pour accéder aux statistiques</h2><br />
         <ul class="done-list">'; 

         if($poll_valid == 0){
			echo '<li class="poll">Vous n\'avez terminé aucun sondage !</li>';
		}
		else{

	        for($i=0;$i<$nb_rows_done;$i++){
	        	if (strlen ($poll_valid_name[$i]) > 16) $space = '...';
	        	else $space = '';
				echo '<li class="poll">
				<a href="poll_stat.php?sondage='.$poll_valid_id[$i].'">
					<figure></figure>
					<article>'.utf8_encode(substr($poll_valid_name[$i], 0, 16)).$space.'</a></article>
				</li>';
	        }
	    }

        echo '</ul></section>';

        //echo '<footer class="foot">&copy; Projet Développement Web - PHP / MySQL</footer>';           

	}
	else{
		echo 'Vous n\'êtes pas connecté. Cliquez <a href="index.php">ici</a> pour revenir à l\'accueil.';
	}



    include("footer.php"); 

?>