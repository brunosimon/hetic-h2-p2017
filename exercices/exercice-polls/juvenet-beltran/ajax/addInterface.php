<?php 

require_once '../config.php';

session_start();

?>

<div id="addInterface">

	<div class="backBar">
		<a href="#" class="back"><span class="icon icon-arrow-left"></span>Retour</a>
		<div class="messageBar">
			<p>dfsdofksp</p>
			<a href="#"><span class="icon icon-close"></span></a>
		</div>
	</div>

		<div class="addBattle">

			<form action="#">
				
				<div class="radio">

				<?php 

				$req = $pdo->prepare('SELECT name FROM categories');
				$req->execute() or die(print_r($req->errorInfo(), TRUE));

				while($donnees = $req->fetch(PDO::FETCH_ASSOC)):?>

				<input type="radio" name="category" value="<?php echo $donnees['name']; ?>"><span class="radioLabel"><?php echo $donnees['name']; ?></span>
	 			
				<?php endwhile; $req->closeCursor(); ?>

				</div>

			<div class="elements">
				<div class="element">
						
						<input type="url" class="img1" name="img1" placeholder="Url de l'image 1"><input type="button" class="up" value="Prévisualiser">
						<img src="" class="image1" alt=""/>
	
					<div class="title"><input type="text" name="item1" placeholder="Nom du 1ère élément"></div>
				</div>
				<div class="element">
						
						<input type="url" class="img2" name="img2" placeholder="Url de l'image 2"><input type="button" class="up" value="Prévisualiser">
						<img src="" class="image2" alt=""/>

					<div class="title"><input type="text" name="item2" placeholder="Nom du 2ème élément"></div>
				</div>
				<div class="vs">VS</div>
			</div>
			
			<input type="hidden" name="submit">

			<input type="button" class="validForm" class="boxed" value="Valider">

		</form>

		</div>

</div>