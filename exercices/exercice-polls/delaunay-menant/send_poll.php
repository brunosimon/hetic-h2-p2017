<?php 

    session_start();
    //$document = basename(__FILE__);
    $titre = "Nouveau sondage";

    include("head.php");

    $errors = array();
	$success = array();

	echo '<section class="create_poll">
	<h1 class="bigger">Probe System</h1>
	<h2 class="fatter">Soumettre un sondage</h2><br />';

	function print_form_poll_param($data){
	
		echo '<form action="#" method="POST">
				<input type="text" name="name_poll" placeholder="Nom du sondage" value ="'.$data['name_poll'].'">
				<input type="number" name="nb_questions" placeholder="Nombre de questions" value ="'.$data['nb_questions'].'">
				<input type="number" name="nb_answers" placeholder="Réponses par question" value ="'.$data['nb_answers'].'">
				<input class="btn valid" type="submit" name="form_poll_param" value="Etape suivante" />
			</form>
		</section>';
	}

	function print_form_poll_new($data, $data_new){
	
		echo '<br /><h2 class="fatter">Nouveau sondage : '.$data['name_poll'].'</h2><br />';

		echo '<form action="#" method="POST">';
		echo '<ul>';

		for ($i=1;$i<=$data['nb_questions'];$i++){
			echo '<li>';
			echo '<input type="text" name="q_'.$i.'" placeholder="Question n°'.$i.'" value ="'.$data_new['q_'.$i].'">';
			echo '<ul class ="poll-list">';

			for ($j=1;$j<=$data['nb_answers'];$j++){
				echo '<li>';
				echo '<input type="text" name="r_'.$i.'_'.$j.'" placeholder="Réponse n°'.$j.'" value ="'.$data_new['r_'.$i.'_'.$j].'"></li>';
			}
			echo '</ul>';
		}
		echo '<ul>';

		echo '<input class="btn valid" type="submit" name="form_poll_new" value="Créer" />
			</form><br /><br /><br />
		</section>';
	}

    function clean_data_param($data){
		$data['name_poll'] = strip_tags(trim($data['name_poll']));
		$data['nb_questions'] = (int)$data['nb_questions'];
		$data['nb_answers'] = (int)$data['nb_answers'];

		return $data;
	}

	function check_data_param($data){

		$errors = array();

		if (empty($data['name_poll']))
			$errors['name_poll'] = 'Erreur : vous devez remplir le champ "Nom du sondage".';

		if (empty($data['nb_questions']))
			$errors['nb_questions'] = 'Erreur : vous devez remplir le champ "Nombre de questions".';

		if (empty($data['nb_answers']))
			$errors['nb_answers'] = 'Erreur : vous devez remplir le champ "Nombre de réponses par question".';

		return $errors;

	}

	function clean_data_new($data, $data_new){
		for ($i=1;$i<=$data['nb_questions'];$i++){
			$data_new['q_'.$i] = strip_tags(trim($data_new['q_'.$i]));
			for ($j=1;$j<=$data['nb_answers'];$j++){
				$data_new['r_'.$i.'_'.$j] = strip_tags(trim($data_new['r_'.$i.'_'.$j]));
			}
		}	

		return $data_new;
	}

	function check_data_new($data, $data_new){

		$errors = array();

		for ($i=1;$i<=$data['nb_questions'];$i++){
			if (empty($data_new['q_'.$i]))
				$errors['q_'.$i] = 'Erreur : vous devez remplir le champ "Question n°'.$i.'".';
			for ($j=1;$j<=$data['nb_answers'];$j++){
				if (empty($data_new['r_'.$i.'_'.$j]))
					$errors['r_'.$i.'_'.$j] = 'Erreur : vous devez remplir le champ "Réponse n°'.$j.' de la question n°'.$i.'".';
			}
		}

		return $errors;

	}

    if(isset($_SESSION['auth']) && $_SESSION['auth'] == true){

    	if (!empty($_POST['form_poll_param'])){

			$data = clean_data_param($_POST);
			$errors = check_data_param($data);

			if (empty($errors)){
				$data_new = array();
				for ($i=1;$i<=$data['nb_questions'];$i++){
					$data_new['q_'.$i] = '';
					for ($j=1;$j<=$data['nb_answers'];$j++){
						$data_new['r_'.$i.'_'.$j] = '';
					}
				}
				
				print_form_poll_new($data, $data_new);

				$_SESSION['name_poll'] = $data['name_poll'];
				$_SESSION['nb_questions'] = $data['nb_questions'];
				$_SESSION['nb_answers'] = $data['nb_answers'];
			}
			else{
				echo '<article class="errors">';

				foreach ($errors as $_errors){
					echo '<p class="error">'.$_errors.'</p>';
				}
				echo '</article>';
				print_form_poll_param($data);
			}

		}

		else if (!empty($_POST['form_poll_new'])){

			$data = array(
				'name_poll' => $_SESSION['name_poll'],
				'nb_questions' => $_SESSION['nb_questions'],
				'nb_answers' => $_SESSION['nb_answers']
			);

			$data_new = clean_data_new($data, $_POST);
			$errors = check_data_new($data, $data_new);

			if (empty($errors)){	
				require_once 'config.inc.php';
				$req_poll = 'INSERT INTO poll (name) VALUES (:name)';
				$insert_poll = $pdo->prepare($req_poll);
				$insert_poll->execute(array('name' => utf8_decode($data['name_poll'])));
				$id_poll = $pdo -> lastInsertId();

				for ($i=1;$i<=$data['nb_questions'];$i++){
					$req_question = 'INSERT INTO questions (name, numero, id_poll) VALUES (:name, :numero, :id_poll)';
					$insert_question = $pdo->prepare($req_question);
					$insert_question->execute(array('name' => utf8_decode($data_new['q_'.$i]), 'numero' => $i, 'id_poll' => $id_poll));
					$id_question = $pdo -> lastInsertId();

					for ($j=1;$j<=$data['nb_answers'];$j++){
						$req_answer = 'INSERT INTO answers (name, numero, id_question, id_poll) VALUES (:name, :numero, :id_question, :id_poll)';
						$insert_answer= $pdo->prepare($req_answer);
						$insert_answer->execute(array('name' => utf8_decode($data_new['r_'.$i.'_'.$j]), 'numero' => $j, 'id_question' => $id_question, 'id_poll' => $id_poll));
					}
				}

				echo '<article class="success">
					Sondage créé ! <br />
					Cliquez <a href="index.php">ici</a> pour revenir à l\'accueil.
					</article>';

			}
			else{
				echo '<article class="errors">';

				foreach ($errors as $_errors){
					echo '<p class="error">'.$_errors.'</p>';
				}
				echo '</article>';
				print_form_poll_new($data, $data_new);
			}

		}
		else{

			$data = array(
				'name_poll' => '',
				'nb_questions' => '',
				'nb_answers' => ''
			);

			print_form_poll_param($data);
		}

	}
	else{
		header('Location:index.php');
		
	}
	//echo '<br /><footer class="foot">&copy; Projet Développement Web - PHP / MySQL</footer>';
    include("footer.php"); 

?>