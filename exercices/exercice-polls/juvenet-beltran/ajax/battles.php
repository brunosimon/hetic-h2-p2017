<?php 

require_once '../config.php';

session_start();

$_SESSION['currentPage'] = 0;

?>

<div id="battles">
	<ul class="battles">
		
		<?php 

		$req = $pdo->prepare('SELECT b.id, b.item1, b.img1, b.item2, b.img2, c.color FROM battles b LEFT JOIN categories c ON b.category = c.name WHERE validate = "1" ORDER BY date DESC');
		$req->execute() or die(print_r($req->errorInfo(), TRUE));

		while($donnees = $req->fetch(PDO::FETCH_ASSOC)):?>
	
		<li class="battle <?php echo $donnees['color']; ?>" data-id="<?php echo $donnees['id']; ?>">
			<a href="#">
				<div class="cut"><img src="<?php echo $donnees['img1']; ?>" alt="<?php echo $donnees['item1']; ?>"></div>
				<div class="cut"><img src="<?php echo $donnees['img2']; ?>" alt="<?php echo $donnees['item2']; ?>"></div>
				<div class="vs">VS</div>
			</a>
			<div class="title <?php echo $donnees['color']; ?>"><?php echo $donnees['item1']; ?> VS <?php echo $donnees['item2']; ?></div>
		</li>
	
		<?php endwhile; 

		$req->closeCursor(); ?>

		<li class="battle">
			<div class="addItem">+</div>
		</li>
		
	</ul>
</div>