<?php

require_once '../config.php';

session_start();

$_GET['id'] = (int) $_GET['id'];

$_SESSION['currentPage'] = $_GET['id'];

if(!isset($_SESSION['vote']))
	$_SESSION['vote'] = array();

$req = $pdo->prepare('SELECT b.id, b.item1, b.img1, b.vote1, b.item2, b.img2, b.vote2, c.color FROM battles b LEFT JOIN categories c ON b.category = c.name WHERE b.id = ?');
$req->execute(array($_GET['id'])) or die(print_r($req->errorInfo(), TRUE));

$donnees = $req->fetch(PDO::FETCH_ASSOC);

$res = 0;

foreach($_SESSION['vote'] as $index => $vote) {
    if($donnees['id'] == $vote['id']) $res = $vote;
}

if($res != 0){ // Si déjà voté.

	$isVote = TRUE; 
	$score1 = ($donnees['vote1'] != 0) ? ($donnees['vote1'] * 100) / ($donnees['vote1']+$donnees['vote2']) : 0;
	$score2 = ($donnees['vote2'] != 0) ? ($donnees['vote2'] * 100) / ($donnees['vote1']+$donnees['vote2']) : 0;

}
else
 $isVote = FALSE; ?>

<div id="battle" class="<?php echo $donnees['color']; ?>" data-id="<?php echo $donnees['id']; ?>">
	<div class="backBar">
		<a href="#" class="back"><span class="icon icon-arrow-left"></span>Retour</a>
	</div>
	<div class="elements">
		<div class="element" <?php if($isVote && ($res['item'] != $donnees['item1'])) echo "style='opacity:0.4;'"; ?> data-name="<?php echo $donnees['item1']; ?>">
			<?php if(!$isVote): ?><a href="#"><?php endif; ?>
				<img src="<?php echo $donnees['img1']; ?>" alt="<?php echo $donnees['item1']; ?>">
			<?php if(!$isVote): ?></a><?php endif; ?>
			<div class="title red"><?php echo $donnees['item1']; ?></div>
		</div>
		<div class="element" <?php if($isVote && ($res['item'] != $donnees['item2'])) echo "style='opacity:0.4;'"; ?> data-name="<?php echo $donnees['item2']; ?>">
			<?php if(!$isVote): ?><a href="#"><?php endif; ?>
				<img src="<?php echo $donnees['img2']; ?>" alt="<?php echo $donnees['item2']; ?>">
			<?php if(!$isVote): ?></a><?php endif; ?>
			<div class="title red"><?php echo $donnees['item2']; ?></div>
		</div>
		<div class="vs">VS</div>
	</div>
</div>

<div id="result" <?php if($isVote) echo "style='display:block;'"; ?>>

	<div class="score1"><?php if($isVote) echo $score1.'%'; ?></div>
	<div class="score2"><?php if($isVote) echo $score2.'%'; ?></div>

</div>

<?php $req->closeCursor(); ?>