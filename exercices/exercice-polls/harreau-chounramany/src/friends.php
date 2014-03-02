<section class="bg-primary welcome">
<img class="img-circle" src="https://graph.facebook.com/<?php echo $user; ?>/picture">
<?php echo "Bonjour ".$user_profile["first_name"]; ?>
</section>

<section class="whitebg">
<div class="jumbotron">
<h1 class="text-center"> Let's <b>Find friends</b> </h1> 
</div>
<?php 

//function for geoloc in php
	function distance($lat1, $lon1, $lat2, $lon2) {

	  $theta = $lon1 - $lon2;
	  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
	  $dist = acos($dist);
	  $dist = rad2deg($dist);
	  $miles = $dist * 60 * 1.1515; 
	  return (round($miles * 1.609344)); // ajustement en KM
	}


	// look for the perfect match 
	
	$searchBig = $pdo->query("SELECT * FROM ff_users 
	WHERE taste1='".$_SESSION['taste1']."'
	AND taste2='".$_SESSION['taste2']."'
	AND taste3='".$_SESSION['taste3']."' 
	AND id_fb!='".$user_profile["id"]."'");

	$searchBig = $searchBig->fetchAll();



	if (empty($searchBig)):?>
		<div class="alert alert-warning">
	  		<strong>Dommage : </strong> Personne n'a trois points communs avec vous :(
		</div>

	<?php elseif (count($searchBig) == 1):?>
 		<h2> Cette personne aussi aime les <?php echo $_SESSION['taste1'];?>s , <?php echo $_SESSION['taste2'];?>, et est plutôt <?php echo $_SESSION['taste3'];?> </h2>
	<?php elseif (count($searchBig) > 1):?>
	<h2><b><?php echo count($searchBig); ?></b> personnes aussi aiment aussi les <?php echo $_SESSION['taste1'];?>s , <?php echo $_SESSION['taste2'];?>, et sont plutôt <?php echo $_SESSION['taste3'];?></h2>
	<?php endif ?>

 <?php for($i = 0, $size = count($searchBig); $i < $size; ++$i) { ?>
	<div class="row"> 
        <div class="well well-sm">
            <div class="row">
				<div class="col-xs-3 col-md-3 text-center">
			   	<img src="https://graph.facebook.com/<?php echo $searchBig[$i]['id_fb']; ?>/picture?width=150&height=150" class="img-thumbnail ">  
				</div>
				<div class="col-xs-9 col-md-9 section-box">
				   	<h4><b>	<?php echo $searchBig[$i]['name']."</b> ".$searchBig[$i]['firstname'];?> </h4>
				   	<hr>
					Aime les <?php echo $searchBig[$i]['taste1'];?>s , <?php echo $searchBig[$i]['taste2'];?>, et est plutôt <?php echo $searchBig[$i]['taste3'];?>
					<br/>
					Actuellement à
					<?php echo distance($_SESSION['longitude'], $_SESSION['latitude'], $searchBig[$i]['longitude'], $searchBig[$i]['latitude']); ?>
					km de vous
					<br/>
					<a href="<?php echo $searchBig[$i]['link']; ?>" >Voir le profil facebook</a>
				</div>	
			</div>
		</div>
	</div>	
				
<?php } ?>

<?php if (count($searchBig) < 10): // if he have more than 10 bigs friends, we don't need that
	$searchMedium = $pdo->query("SELECT * FROM ff_users 
	WHERE (taste1='".$_SESSION['taste1']."'
	AND taste2='".$_SESSION['taste2']."'
	AND taste3!='".$_SESSION['taste3']."' 
	AND id_fb!='".$user_profile["id"]."')

	OR (taste1='".$_SESSION['taste1']."'
	AND taste2!='".$_SESSION['taste2']."'
	AND taste3='".$_SESSION['taste3']."' 
	AND id_fb!='".$user_profile["id"]."')

	OR (taste1!='".$_SESSION['taste1']."'
	AND taste2='".$_SESSION['taste2']."'
	AND taste3='".$_SESSION['taste3']."' 
	AND id_fb!='".$user_profile["id"]."')
	");

	$searchMedium = $searchMedium->fetchAll();
	endif
 ?> 
	<br/>

<?php if(empty($searchMedium)):?>
	<div class="has-error">Erreur : Pas d'amis trouvé</div>
<?php elseif (count($searchMedium) == 1):?>
	<h2 >Cette personne à 2 goûts communs avec vous. </h2>
<?php else:?>
	<h2 > <b><?php echo count($searchMedium); ?></b> personnes ont 2 goûts communs avec vous. </h2>
 <?php endif; ?>

<?php
for($i = 0, $size = count($searchMedium); $i < $size; ++$i) { ?>
	<div class="row">
	 
            <div class="well well-sm">
                <div class="row">
					<div class="col-xs-3 col-md-3 text-center">
				   	<img src="https://graph.facebook.com/<?php echo $searchMedium[$i]['id_fb']; ?>/picture?width=150&height=150" class="img-thumbnail ">  
					</div>
					<div class="col-xs-9 col-md-9 section-box">
				   	<h4><b>	<?php echo $searchMedium[$i]['name']."</b> ".$searchMedium[$i]['firstname'];?> </h4>
				   	<hr>
					Aime les <?php echo $searchMedium[$i]['taste1'];?>s , <?php echo $searchMedium[$i]['taste2'];?>, et est plutôt <?php echo $searchMedium[$i]['taste3'];?>
					<br/>
					Actuellement à
					<?php echo distance($_SESSION['longitude'], $_SESSION['latitude'], $searchMedium[$i]['longitude'], $searchMedium[$i]['latitude']); ?>
					km de vous
					<br/>
					<a href="<?php echo $searchMedium[$i]['link']; ?>" >Voir le profil facebook</a>
					
				</div>	
			</div>
		
	</div>
	
	</div>
	
<?php	 
}
	?>





</br>
<h2> Quelques chiffres </h2>
</br>
<?php


// Sondage 1
$sondage1 = $pdo->query("SELECT taste1, COUNT(*) FROM ff_users GROUP BY taste1;");
$sondage1 = $sondage1->fetchAll();

$resultChat = round(($sondage1['0']['COUNT(*)'] / ($sondage1['1']['COUNT(*)']+$sondage1['0']['COUNT(*)']))*100);
$resultChien = 100 - $resultChat;
?>

<?php
echo "<b>".$resultChat."%</b> des utilisateurs de find friends aiment les chats ";
echo "<b>".$resultChien."%</b>  préférent les chiens";

?>
<div class="progress">
  <div class="progress-bar progress-bar" style="width: <?php echo $resultChat; ?>%">
    <span class="sr-only"><?php echo $resultChat ;?> Complete </span>
  </div>
  <div class="progress-bar progress-bar-info" style="width: <?php echo $resultChien; ?>%">
    <span class="sr-only"><?php echo $resultChien; ?> Complete </span>
  </div>
</div>
</br>
<?php

// Sondage 2

$sondage2 = $pdo->query("SELECT taste2, COUNT(*) FROM ff_users GROUP BY taste2;");
$sondage2 = $sondage2->fetchAll();

$totalLoisir = ($sondage2['0']['COUNT(*)']+$sondage2['1']['COUNT(*)']+$sondage2['2']['COUNT(*)']+$sondage2['3']['COUNT(*)']);

$lire = round($sondage2['0']['COUNT(*)']/$totalLoisir*100);
$sortir = round($sondage2['1']['COUNT(*)']/$totalLoisir*100);
$game = round($sondage2['2']['COUNT(*)']/$totalLoisir*100);
$sport = round($sondage2['3']['COUNT(*)']/$totalLoisir*100);

echo "<b>".$lire."%</b> des utilisateurs de find friends aiment lire ";
echo "<b>".$sortir."%</b>  préférent sortir, ";
echo "<b>".$game."%</b>  préférent jouer aux jeux vidéos et ";
echo "<b>".$sport."%</b>  préférent faire du sport";

?>

<div class="progress">
  <div class="progress-bar progress-bar" style="width: <?php echo $lire; ?>%">
    <span class="sr-only"><?php echo $lire ;?> Complete </span>
  </div>
  <div class="progress-bar progress-bar-info" style="width: <?php echo $sortir; ?>%">
    <span class="sr-only"><?php echo $sortir; ?> Complete </span>
  </div>
  <div class="progress-bar progress-bar-warning" style="width: <?php echo $game; ?>%">
    <span class="sr-only"><?php echo $game; ?> Complete </span>
  </div>
  <div class="progress-bar progress-bar-success" style="width: <?php echo $sport; ?>%">
    <span class="sr-only"><?php echo $sport; ?> Complete </span>
  </div>
</div>
</br>

<?php
// Sondage 1

$sondage3 = $pdo->query("SELECT taste1, COUNT(*) FROM ff_users GROUP BY taste1;");
$sondage3 = $sondage3->fetchAll();

$resultMatin = round(($sondage3['0']['COUNT(*)'] / ($sondage3['1']['COUNT(*)']+$sondage3['0']['COUNT(*)']))*100);
$resultSoir = 100 - $resultMatin;

echo "<b>".$resultMatin."%</b> des utilisateurs de find friends sont du matin ";
echo "<b>".$resultSoir."%</b>  sont plutôt du soir";

?>

<div class="progress">
  <div class="progress-bar progress-bar-success" style="width: <?php echo $resultMatin; ?>%">
    <span class="sr-only"><?php echo $resultMatin ;?> Complete </span>
  </div>
  <div class="progress-bar progress-bar-info" style="width: <?php echo $resultSoir; ?>%">
    <span class="sr-only"><?php echo $resultSoir; ?> Complete </span>
  </div>
</div>

<p> Finds Friend, By Matthieu Harreau et Vannaly Chounramany. </p>