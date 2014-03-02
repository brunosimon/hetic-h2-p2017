<?php

class Survey {

	public function select_all (){
		$select = DATABASE::DB()->query("SELECT * FROM surveys");
		$affichage = "";
		while ($value = $select->fetch()){
			$affichage .='
			<tr>	
				<td>'.$value['name'].'</td>
				<td class="text-right"><a class="btn btn-success btn-xs" href="index.php?page=survey&id='.$value['id'].'">Voter !</a></td>
		    </tr>
			';
		}
		echo $affichage;
	}

	public function last_5 (){
		$select = DATABASE::DB()->query("SELECT * FROM surveys ORDER BY `id` ASC LIMIT 5");
		while($value = $select->fetch()){
			echo "
			<tr>
				<td>".$value['name']."</td>
				<td><a href=\"index.php?page=survey&id=".$value['id']."\" class=\"btn btn-success btn-xs\">Voter !</a></td>
	  		</tr>";
		}
	}

	public function select_own_surveys ($id){
		$select = DATABASE::DB()->prepare("SELECT * FROM surveys WHERE id_user = :id");
		$select->bindvalue(':id', $id, PDO::PARAM_INT);
		$select->execute();
		$affichage = "";
		while ($value = $select->fetch()){
			$affichage .='
			<tr>	
				<td>'.$value['id'].'</td>
				<td class="text-center">'.$value['name'].'</td>
				<td class="text-right"><a href="index.php?page=survey_delete&action=delete&id='.$value['id'].'" class="btn btn-danger btn-xs">Supprimer</a></td>
		    </tr>
			';
		}
		echo $affichage;
	}

	public function delete_survey ($id){
		$delete_survey = DATABASE::DB()->prepare("DELETE FROM surveys WHERE id = :id");
		$delete_votes = DATABASE::DB()->prepare("DELETE FROM votes WHERE id_survey = :id");

		$delete_survey->bindvalue(':id', $id, PDO::PARAM_INT);
		$delete_votes->bindvalue(':id', $id, PDO::PARAM_INT);

		$delete_survey->execute();
		$delete_votes->execute();
	}

	public function select_name ($id){
		$select_id = DATABASE::DB()->prepare("SELECT name FROM surveys WHERE id = :id");
		$select_id->bindvalue(':id', $id, PDO::PARAM_INT);
		$select_id->execute();
		$affichage = $select_id->fetch();
		echo $affichage['name'];
	}

	public function select_description ($id){
		$select_id = DATABASE::DB()->prepare("SELECT description FROM surveys WHERE id = :id");
		$select_id->bindvalue(':id', $id, PDO::PARAM_INT);
		$select_id->execute();
		$affichage = $select_id->fetch();
		echo $affichage['description'];
	}

	public function select_issues ($id){
		$select = DATABASE::DB()->prepare("SELECT * FROM surveys WHERE id = :id");
		$select->bindvalue(':id', $id, PDO::PARAM_INT);
		$select->execute();

		$choice_1 = 0;
		$choice_2 = 0;
		$choice_3 = 0;
		$choice_4 = 0;
		$choice_5 = 0;

		while ($value = $select->fetch()){	
			if($value['choice_1'] != null && $choice_1 == 0){
				echo "
				<label class=\"checkbox-inline\">
				 	<input type=\"radio\" id=\"inlineCheckbox1\" value=\"".$value['choice_1']."\" name=\"choice\"> ".$value['choice_1']."
				</label>
				";
				$choice_1 = 1;
			}
			if($value['choice_2'] != null && $choice_2 == 0){
				echo "
				<label class=\"checkbox-inline\">
				 	<input type=\"radio\" id=\"inlineCheckbox1\" value=\"".$value['choice_2']."\" name=\"choice\"> ".$value['choice_2']."
				</label>
				";
				$choice_2 = 1;
			}
			if($value['choice_3'] != null && $choice_3 == 0){
				echo "
				<label class=\"checkbox-inline\">
				 	<input type=\"radio\" id=\"inlineCheckbox1\" value=\"".$value['choice_3']."\" name=\"choice\"> ".$value['choice_3']."
				</label>
				";
				$choice_3 = 1;
			}
			if($value['choice_4'] != null && $choice_4 == 0){
				echo "
				<label class=\"checkbox-inline\">
				 	<input type=\"radio\" id=\"inlineCheckbox1\" value=\"".$value['choice_4']."\" name=\"choice\"> ".$value['choice_4']."
				</label>
				";
				$choice_4 = 1;
			}
			if($value['choice_5'] != null && $choice_5 == 0){
				echo "
				<label class=\"checkbox-inline\">
				 	<input type=\"radio\" id=\"inlineCheckbox1\" value=\"".$value['choice_5']."\" name=\"choice\"> ".$value['choice_5']."
				</label>
				";
				$choice_5 = 1;
			}
		}
	}

	public function select_choice ($value, $id){
		$select_choice = DATABASE::DB()->prepare("SELECT * FROM surveys WHERE id = :id");
		$select_choice->bindvalue(':id', $id, PDO::PARAM_INT);
		$select_choice->execute();
		$affichage_choice = $select_choice->fetch();

		switch ($value){
			case 'choice_1':
				if ($affichage_choice['choice_1'] != ""){
					echo '<span class="btn-primary btn-lg">'.$affichage_choice['choice_1'].'</span>';
				}
				break;
			case 'choice_2':
				if ($affichage_choice['choice_2'] != ""){
					echo '<span class="btn-success btn-lg">'.$affichage_choice['choice_2'].'</span>';
				}
				break;
			case 'choice_3':
				if ($affichage_choice['choice_3'] != ""){
					echo '<span class="btn-info btn-lg">'.$affichage_choice['choice_3'].'</span>';
				}
				break;
			case 'choice_4':
				if ($affichage_choice['choice_4'] != ""){
					echo '<span class="btn-warning btn-lg">'.$affichage_choice['choice_4'].'</span>';
				}
				break;
			case 'choice_5':
				if ($affichage_choice['choice_5'] != ""){
					echo '<span class="btn-danger btn-lg">'.$affichage_choice['choice_5'].'</span>';
				}
				break;
		}
	}

	public function select_votes ($id){
		$select_choice = DATABASE::DB()->prepare("SELECT * FROM surveys WHERE id = :id");
		$select_choice->bindvalue(':id', $id, PDO::PARAM_INT);
		$select_choice->execute();
		$affichage_choice = $select_choice->fetch();

		$select = DATABASE::DB()->prepare("SELECT * FROM votes WHERE id_survey = :id");
		$select->bindvalue(':id', $id, PDO::PARAM_INT);
		$select->execute();

		$count_1 = 0;
		$count_2 = 0;
		$count_3 = 0;
		$count_4 = 0;
		$count_5 = 0;

		while ($value = $select->fetch()){
			switch ($value['choice']){
				case $affichage_choice['choice_1']:	$count_1++;	break;
				case $affichage_choice['choice_2']:	$count_2++;	break;
				case $affichage_choice['choice_3']:	$count_3++;	break;
				case $affichage_choice['choice_4']:	$count_4++;	break;
				case $affichage_choice['choice_5']:	$count_5++;	break;
			}
		}

		if ($count_1 != 0){
			echo '
			{
				value: '.$count_1.',
				color:"#428bca"
			},';
		}
		if ($count_2 != 0){
			echo '
			{
				value: '.$count_2.',
				color:"#5cb85c"
			},
			';
		}
		if ($count_3 != 0){
			echo '
			{
				value: '.$count_3.',
				color:"#5bc0de"
			},
			';
		}
		if ($count_4 != 0){
			echo '
			{
				value: '.$count_4.',
				color:"#f0ad4e"
			},
			';
		}
		if ($count_5 != 0){
			echo '
			{
				value: '.$count_5.',
				color:"#d9534f"
			},
			';
		}
	}

	public function add_vote ($id_user, $id_survey, $choice){
		$verification = DATABASE::DB()->prepare("SELECT * FROM votes WHERE id_user = :id_user AND id_survey = :id_survey");
		$verification->bindvalue(':id_user', $id_user, PDO::PARAM_INT);
		$verification->bindvalue(':id_survey', $id_survey, PDO::PARAM_INT);
		$verification->execute();
		$correspondance = $verification->fetch();

		if ($correspondance){
			$update = DATABASE::DB()->prepare("UPDATE votes SET choice = :choice WHERE id_survey = :id_survey AND id_user = :id_user");
			$update->bindvalue(':id_user', $id_user, PDO::PARAM_INT);
			$update->bindvalue(':id_survey', $id_survey, PDO::PARAM_INT);
			$update->bindvalue(':choice', $choice, PDO::PARAM_STR);
			$update->execute();
		} else{
			$insert = DATABASE::DB()->prepare("INSERT INTO votes (id_user, id_survey, choice) VALUES (:id_user, :id_survey, :choice)");
			$insert->bindvalue(':id_user', $id_user, PDO::PARAM_INT);
			$insert->bindvalue(':id_survey', $id_survey, PDO::PARAM_INT);
			$insert->bindvalue(':choice', $choice, PDO::PARAM_STR);
			$insert->execute();
		}
	}

	public function add_survey ($post){
		extract($post);

		(isset($choice_1)) ? $choice_1 = $choice_1 : $choice_1 = '';
		(isset($choice_2)) ? $choice_2 = $choice_2 : $choice_2 = '';
		(isset($choice_3)) ? $choice_3 = $choice_3 : $choice_3 = '';
		(isset($choice_4)) ? $choice_4 = $choice_4 : $choice_4 = '';
		(isset($choice_5)) ? $choice_5 = $choice_5 : $choice_5 = '';

		$insert = DATABASE::DB()->prepare("INSERT INTO surveys (id_user, name, description, choice_1, choice_2, choice_3, choice_4, choice_5) VALUES (:id_user, :name, :description, :choice_1, :choice_2, :choice_3, :choice_4, :choice_5)");
		$insert->bindvalue(':id_user', $_SESSION['id'], PDO::PARAM_INT);
		$insert->bindvalue(':name', $name, PDO::PARAM_STR);
		$insert->bindvalue(':description', $description, PDO::PARAM_STR);
		$insert->bindvalue(':choice_1', $choice_1, PDO::PARAM_STR);
		$insert->bindvalue(':choice_2', $choice_2, PDO::PARAM_STR);
		$insert->bindvalue(':choice_3', $choice_3, PDO::PARAM_STR);
		$insert->bindvalue(':choice_4', $choice_4, PDO::PARAM_STR);
		$insert->bindvalue(':choice_5', $choice_5, PDO::PARAM_STR);
		$insert->execute();
	}
}
?>