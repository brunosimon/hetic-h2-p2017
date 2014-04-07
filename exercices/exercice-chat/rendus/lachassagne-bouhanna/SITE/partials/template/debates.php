<div class="container container-debates">
	<ul class="debates">

		<?php

			$prepare = $pdo->prepare('SELECT * FROM debates');
			$prepare->execute();
			$debates = $prepare->fetchAll();

			foreach ($debates as $key => $value) :
				$debateName 	= $value['debateName'];
				$debateCate 	= $value['debateCate'];
				$debateImage 	= $value['debateImage'];
				$debateId			= $value['id']
			

		?>
		<a href="partials/template/debate.php?id=<?php echo $debateId ?>">
			<li class="debate">
				<img src="<?php echo $debateImage; ?>" alt="Image debate" class="img-debate">
				<p class="cate-debate">Category : <?php echo $debateCate ?></p>
				<p class="debate-title"><?php echo $debateName ?></p>
			</li>
		</a>

	<?php endforeach; ?>

	</ul>
</div>