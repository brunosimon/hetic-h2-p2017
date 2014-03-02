<?php

// Récupération des variables du formulaire
			$rep1 = $_POST['name1'];
			$rep2 = $_POST['name2'];
			$rep3 = $_POST['name3'];
			$rep4 = $_POST['name4'];
			$rep5 = $_POST['name5'];
			$rep6 = $_POST['name6'];
			$rep7 = $_POST['name7'];
			$rep8 = $_POST['name8'];
			$rep9 = $_POST['name9'];
			$rep10 = $_POST['name10'];

// Calcule le score
$score = $rep1 + $rep2 + $rep3 + $rep4 + $rep5 + $rep6 + $rep7 + $rep8 + $rep9 + $rep10;

// Résultat en fonction du score obtenu
echo "<h3>Votre score est de ". $score ."</h3>";

if ($score <5) {
  echo "<p>Vous etes du coté obscure</p>";

} elseif ($score >=5) {
  echo "<p>La lumière est en vous</p>";
}