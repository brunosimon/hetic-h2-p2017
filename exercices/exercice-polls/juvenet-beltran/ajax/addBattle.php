<?php 

require_once '../config.php';

session_start();

if(isset($_POST['submit'])){
	if(!empty($_POST['category'])){
		if(!empty($_POST['img1']) && !empty($_POST['img2'])){
			if(!empty($_POST['item1']) && !empty($_POST['item2'])){
				if(strlen($_POST['item1']) <= 14 && strlen($_POST['item2']) <= 14){

					$req = $pdo->prepare('INSERT INTO battles (category, date, item1, img1, item2, img2) VALUES (?, NOW(), ?, ?, ?, ?)');
					$req->execute(array($_POST['category'], $_POST['item1'], $_POST['img1'], $_POST['item2'], $_POST['img2'])) or die(print_r($req->errorInfo(), TRUE));

					$req->closeCursor();

					echo json_encode(array("statut" => "success", "message" => "Votre battle a été créée avec succès, elle est néanmoins en attente de VALIDATION (désactivé pour les tests)."));
				}
				else
					echo json_encode(array("statut" => "error", "message" => "Le nom de vos éléments ne doit pas dépasser 14 caractères."));
			}
			else
				echo json_encode(array("statut" => "error", "message" => "Veuillez remplir correctement les noms de vos éléments"));
		}
		else
			echo json_encode(array("statut" => "error", "message" => "Veuillez remplir correctement les champs images"));
	}
	else
		echo json_encode(array("statut" => "error", "message" => "Le champ catégorie est vide"));
}

?>