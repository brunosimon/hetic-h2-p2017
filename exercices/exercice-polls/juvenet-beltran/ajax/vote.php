<?php 

require_once '../config.php';

session_start();

$_GET['id'] = (int) $_GET['id'];
$_GET['item'] = htmlspecialchars($_GET['item']);

if(!isset($_SESSION['vote']))
	$_SESSION['vote'] = array();

$res = 0;

foreach($_SESSION['vote'] as $index => $vote) {
    if($_GET['id'] == $vote['id']) $res = $vote;
}

if($res == 0){
	$arrayVote = array('id' => $_GET['id'], 'item' => $_GET['item']);

	array_push($_SESSION['vote'], $arrayVote);

	$req = $pdo->prepare('SELECT b.item1, b.vote1, b.item2, b.vote2 FROM battles b WHERE b.id = ?');
	$req->execute(array($_GET['id'])) or die(print_r($req->errorInfo(), TRUE));

	$donnees = $req->fetch(PDO::FETCH_ASSOC);

	if($_GET['item'] == $donnees['item1'] || $_GET['item'] == $donnees['item2']){

		($_GET['item'] == $donnees['item1']) ? $donnees['vote1']++ : $donnees['vote2']++;

		$score1 = ($donnees['vote1'] != 0) ? ($donnees['vote1'] * 100) / ($donnees['vote1']+$donnees['vote2']) : 0;
		$score2 = ($donnees['vote2'] != 0) ? ($donnees['vote2'] * 100) / ($donnees['vote1']+$donnees['vote2']) : 0;

		$req->closeCursor();

		$req = $pdo->prepare('UPDATE battles SET vote1 = ?, vote2 = ? WHERE id = ?');
		$req->execute(array($donnees['vote1'], $donnees['vote2'], $_GET['id'])) or die(print_r($req->errorInfo(), TRUE));

		$req->closeCursor();

		echo json_encode(array("statut" => "Vote", "score1" => $score1, "score2" => $score2));
	}
	else
		echo json_encode(array("statut" => "Erreur : item doesn't exist"));
}
else
	echo json_encode(array("statut" => "Erreur : Already Voted"));
?>