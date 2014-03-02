<?php

if ( isset( $_POST['nom'] ) && empty( $_POST['nom'] ) ) {
	header("Location: connection.php?err_no=304");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sondage</title>
    <style>
    	*
	 	{
	 		font-family: Arial;
	 		text-align: center;
	 	}
    	body
    	{
    		background: #C1E8B7;
    	}
    </style>
</head>
<body>
	<p><strong> Bonjour <?php echo $_POST['nom'] ?>. Veuillez répondre à notre sondage. </strong></p></br>
	
	<p> <strong> Vous aimez quand c'est : </strong></p>
	<form action="config_connection.php" method="post"> 
			<div>
				<input type="radio" name="cathegorie" value="sucre" id="sucre" checked/>
				<label for="sucre">Sucré</label>
			</div>	
				<input type="radio" name="cathegorie" value="acidule" id="acidule"/>
				<label for="acidule">Acidulé</label></br>
			</p></br>

			<p><strong> Vous préférez :</strong> </p>

			<p>
				<input type="radio" name="fruit" value="fraise" id="fraise" checked/>
				<label for="fraise">La fraise</label>

				<input type="radio" name="fruit" value="pistache" id="pistache"/>
				<label for="pistache">La pistache</label>

				<input type="radio" name="fruit" value="cerise" id="cerise"/>
				<label for="cerise">La cerise</label>

				<input type="radio" name="fruit" value="abricot" id="abricot"/>
				<label for="abricot">L'abricot</label>

				<input type="radio" name="fruit" value="banane" id="banane"/>
				<label for="banane">La banane</label>
			</p></br>
			
			<p><strong> Vous préférez quand c'est :</strong> </p>
				<input type="radio" name="texture" value="fondant" id="fondant" checked/>
				<label for="fondant">Fondant</label>

				<input type="radio" name="texture" value="craquant" id="craquant"/>
				<label for="craquant">Craquant</label>

				<input type="radio" name="texture" value="petillant" id="petillant"/>
				<label for="petillant">Petillant</label>

				<input type="radio" name="texture" value="granuleux" id="granuleux"/>
				<label for="granuleux">Granuleux</label>
			</p></br>
			</br><input type="submit" value="Valider">

	</form>

</body>
</html>