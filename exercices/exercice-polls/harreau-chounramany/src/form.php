<section class="whitebg">
<div id="coord" class="invisible">
</div>
<h1 class="text-center"> Bienvenue sur Finds friends ! </h1> 

 <form action="#" method="post">
      <fieldset>
      <legend> Parlons de vous, <?php echo $user_profile["first_name"]?> </legend>
       
       <p>	
          <h3 class="text-primary"> Votre animal préféré ? </h4>
          
          	<div class= "btn-group btn-group-justified">
	        	<div class="btn-group">
	       			<label for="chien" class="btn btn-default">    
	            
		       			<input type="radio" name="animal" id="chien" value="chien" checked>
		        		Le chien
	        		</label>
	      		</div>

				<div class="btn-group">   
					<label for="chat"  class="btn btn-default "> 
		       			<input type="radio" name="animal" id="chat" value="chat" >
		      			Le chat
					</label>
				</div>
			</div>
 		</p>

 		<p>
        	<h3 class="text-primary">Votre activité préféré ? </h3>   

        	<div class= "btn-group btn-group-justified">  
        		<div class="btn-group">
        			<label for = "lire" class="btn btn-default ">
        				<input type = "radio" name = "activite" id = "lire" value = "lire" checked>
        			La lecture
        			</label>
        		</div>

	        	<div class="btn-group">
	        		<label for = "sortir" class="btn btn-default ">
	        			<input type = "radio" name = "activite" id = "sortir" value = "sortir" >
	        		Sortir
	        		</label>
	        	</div>
			</div>
			<div class= "btn-group btn-group-justified">  
		        <div class="btn-group">
		        	<label for = "game" class="btn btn-default ">
		       			<input type = "radio" name = "activite" id = "game" value = "jouer aux jeux videos" >
		        		Les jeux vidéos
		        	</label>
		        </div>

		        <div class="btn-group">
		      		<label for = "sport" class="btn btn-default ">
		       			<input type = "radio" name = "activite" id = "sport" value = "faire du Sport" >
		        		Le sport
		        	</label>
		        </div>
		    </div>
 		</p>

       <p>	
          <h3 class="text-primary"> Vous êtes plutôt </h4>
          
          	<div class= "btn-group btn-group-justified">
	        	<div class="btn-group">
	       			<label for="matin" class="btn btn-default">
		       			<input type = "radio" name = "time" id = "matin" value = "du matin" checked >
		        		du matin
	        		</label>
	      		</div>

				<div class="btn-group">   
					<label for="soir"  class="btn btn-default "> 
		       			<input type = "radio" name = "time" id = "soir" value = "du soir" >
		      			du soir
					</label>
				</div>
			</div>
 		</p>



          <input type="hidden" name="lati" id="lati" value="">
          <input type="hidden" name="longi" id="longi" value="">
          </br>
        <div class="span6" style="text-align:center">
          	<input type="submit" value="C'est parti !" class="btn btn-primary btn-lg center" >
        </div>
      </fieldset>     
    </form>

<script type="text/javascript">

var x=document.getElementById("coord");
function getLocation()
  {
  if (navigator.geolocation)
    {
    navigator.geolocation.getCurrentPosition(showPosition);
    }
  else{x.innerHTML="Geolocation is not supported by this browser.";}
  }
function showPosition(position)
  {
  x.innerHTML="Latitude: " + position.coords.latitude + 
  "<br>Longitude: " + position.coords.longitude;	

document.getElementById("lati").value = position.coords.latitude;
document.getElementById("longi").value = position.coords.longitude;

  }
  getLocation();
</script>

<?php
$t=time();

$lastupdate = date("Y-m-d H:i:s",$t);


if (!empty($_POST["longi"])){
$pdo -> exec(
	'INSERT INTO `ff_users`(
		`name`,
		`firstname`,
		`id_fb`,
		`longitude`,
		`latitude`,
		`lastupdate`,
		`taste1`,
		`taste2`,
		`taste3`,
		`link`) 
	VALUES (
		"'.mysql_escape_string($user_profile["last_name"]).'",
		"'.mysql_escape_string($user_profile["first_name"]).'",
		"'.$user_profile["id"].'",
		"'.$_POST["longi"].'",
		"'.$_POST["lati"].'",
		"'.$lastupdate.'",
		"'.$_POST["animal"].'",
		"'.$_POST["activite"].'",
		"'.$_POST["time"].'",
		"'.mysql_escape_string($user_profile["link"]).'"
		)'
);



echo "<script>window.location.reload();</script>";


}
else {
	echo "<div class='alert alert-info'>Pour utiliser notre service merci d'accepter la géolocalisation</div>";
}
//VALUES ("'.mysql_escape_string($user_profile["last_name"]).'","'.mysql_escape_string($user_profile["first_name"]).'","'.$user_profile["id"].'","'.mysql_escape_string($user_profile["link"]).'")');
//	$exec = $pdo->exec('INSERT INTO user (nom) VALUES (\''.$_POST['nom'].'\')');
?>
</secion>
