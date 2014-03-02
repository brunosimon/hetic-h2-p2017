<?php
	require'config.php';
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title> Sondage </title>
	<link rel="stylesheet" href="style.css">
</head>
<body>


<div class="poll">
	<p class="sentence1"><strong>Classe tes séries préférées selon leurs catégories !</strong><p>
	<form action="results.php" method="post">

	<div class="drama">
		<p><strong>Drame :</strong></p>
		<?php foreach($drama as $_key => $_value): ?>
			<input type="radio" name="drama" value="<?php echo $_key; ?>" id="value="<?php echo $_key; ?> required>
			<label for"<?php echo $_key; ?>"><?php echo $_value;?></label>
		<?php endforeach; ?>
	</div>

	<div class="Action">
		<p><strong>Action :</strong></p>
		<br /> <?php foreach($action as $_key => $_value): ?>
			<input type="radio" name="action" value="<?php echo $_key; ?>" id="value="<?php echo $_key; ?> required>
			<label for"<?php echo $_key; ?>"><?php echo $_value;?></label>
		<?php endforeach; ?>
	</div>

	<div class="sciencefiction">
		<p><strong>Science-Fiction :</strong></p>
		<br /> <?php foreach($sciencefiction as $_key => $_value): ?>
			<input type="radio" name="sciencefiction" value="<?php echo $_key; ?>" id="value="<?php echo $_key; ?> required>
			<label for"<?php echo $_key; ?>"><?php echo $_value;?></label>
		<?php endforeach; ?>
	</div>

	<div class="comedy">
		<p><strong>Comédie :</strong></p>
		<br /> <?php foreach($comedy as $_key => $_value): ?>
			<input type="radio" name="comedy" value="<?php echo $_key; ?>" id="value="<?php echo $_key; ?> required>
			<label for"<?php echo $_key; ?>"><?php echo $_value;?></label>
		<?php endforeach; ?>
	</div>

	<div class="fantastic">
		<p><strong>Fantastique :</strong></p>
		<br /> <?php foreach($fantastic as $_key => $_value): ?>
			<input type="radio" name="fantastic" value="<?php echo $_key; ?>" id="value="<?php echo $_key; ?> required>
			<label for"<?php echo $_key; ?>"><?php echo $_value;?></label>
		<?php endforeach; ?>
	</div>

		<br /><input type="submit">

	</form>
</div>
</body>

</html>