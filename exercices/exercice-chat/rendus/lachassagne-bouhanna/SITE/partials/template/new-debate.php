<?php

	if(!empty($_POST)) {
		$debateName 	= $_POST['debate-name'];
		$debateCate 	= $_POST['debate-cate'];
		$debateImage 	= $_POST['debate-image'];
		$idCreator		= $_SESSION['id'];
		$debateDesc 	= $_POST['debate-description'];
		$writable		= true;
		$error			= "";

		$prepare = $pdo->prepare('SELECT * FROM debates');
		$prepare -> execute();
		$debates = $prepare->fetchAll();

		foreach ($debates as $key => $value) {
			if($value['debateName']==$debateName) {
				$writable = false;
			}
		}

		if($writable==true){
			if(!empty($_POST['debate-image'])) {
				$prepare = $pdo->prepare('INSERT INTO debates (debateName,debateCate,debateImage,idCreator,debateDesc) VALUES (:name,:cate,:image,:idCreator,:debateDesc)');
				$prepare ->bindValue(':name',$debateName,PDO::PARAM_STR);
				$prepare ->bindValue(':cate',$debateCate,PDO::PARAM_STR);
				$prepare ->bindValue(':image',$debateImage,PDO::PARAM_STR);
				$prepare ->bindValue(':debateDesc',$debateDesc,PDO::PARAM_STR);
				$prepare ->bindValue(':idCreator',$idCreator,PDO::PARAM_STR);
				$prepare ->execute();

				if($prepare){
					echo "success";
					header("Location: /");
				} else {
					echo "something went wrong";
				}
			} else {
				$error = "Image required";
			}
		} else {
			$error = "Debate name already exists";
		}
	}

?>
<div class="container-log">
	<form action="#" method="POST">
		
		<div class="form-group">
			<label for="debate-name">Name*</label>
			<input type="text" name="debate-name" id="debate-name">
		</div>
		<div class="form-group">
		<label for="debate-cate">Category</label>
			<select name="debate-cate" id="debate-cate">
				<option value="politic">Politic</option>
				<option value="date">Dating</option>
				<option value="news">News</option>
				<option value="adult">Adult</option>
				<option value="animal">Animals</option>
				<option value="teen">Teens</option>
				<option value="senior">Seniors</option>
				<option value="sport">Sports</option>
				<option value="various">Various</option>
				<option value="video-games">Video Games</option>
			</select>
		</div>
		<div class="form-group">
			<label for="debate-image">Short description</label>
			<textarea name="debate-description" id="debate-description"></textarea>
		</div>
		<div class="form-group">
			<label for="debate-image">Picture*</label>
			<input type="text" name="debate-image" id="debate-image">
			<p>* fields are required</p>
		</div>
		<?php 

			if(!empty($error)) 
				echo $error;	
		?>
		<div class="form-group">
			<input type="submit" class="btn btn-default">
		</div>

	</form>
</div>