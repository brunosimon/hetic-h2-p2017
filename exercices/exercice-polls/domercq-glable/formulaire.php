<!DOCTYPE html>
<html>
  <head>
  
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Boring survey</title>
  	<link rel="stylesheet" href="src/css/reset.css">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
  	<link rel="stylesheet" href="src/css/style.css">
    <link rel="stylesheet" href="src/css/questionnaire.css">

  </head>

  <body>
    <header>
    <h1><a href="index.php">Boring survey</a></h1>
    </header> 
    <section class="intro">
    <?php
     include('src/php/connexion.php');

      ?>      
      
          </section>
    <div class="formulaire">

    <?php 

    extract($_POST); 
    
        $css_lab_err = "class=\"erreur-label\"";
        $css_input_err = "class=\"erreur-label\"";

        require_once 'src/php/form.php';

        if(!isset($erreurrrr)) $erreurrrr[] = 0;
        
        if(isset($_POST['submit'])){
            check_form();
        /*Extraction des valeurs en variable*/  
        /*On enregistre dans la BDD*/

        //
        if (isset($first_name) AND isset($last_name) AND isset($sex) AND isset($age) AND isset($home) AND isset($postal_code) AND isset($study)) 
        {
            $first_name = htmlspecialchars($first_name);
            $last_name = htmlspecialchars($last_name);
            $sex = htmlspecialchars($sex);
            $age = htmlspecialchars($age);
            $home = htmlspecialchars($home);
            $postal_code = htmlspecialchars($postal_code);
            $study = htmlspecialchars($study);
            if(!isset($work)) $work = NULL;
                $work = htmlspecialchars($work);
            if(!isset($stud_wh)) $stud_wh = NULL;
                $stud_wh = htmlspecialchars($stud_wh);
            if(!isset($place)) $place = NULL;
                $place = htmlspecialchars($place);
            if(!isset($stud_place)) $stud_place = NULL;
                $stud_place = htmlspecialchars($stud_place);
            if(!isset($stud_work)) $stud_work = NULL;
                $stud_work = htmlspecialchars($stud_work);


        /*Ce n'est pas vide, génial ! Donc on enregistre dans la BDD*/
         $bdd->exec("INSERT INTO results (first_name,last_name,sex,age,home,postal_code,study, work, stud_wh, place, stud_place, stud_work) VALUES ('$first_name','$last_name','$sex','$age','$home','$postal_code','$study','$work','$stud_wh','$place','$stud_place','stud_work')") or die (mysql_error());
        $reussite = 1;
        }
        else { $reussite = 2;}
        }

      ?>



    <div class="container">
    <?php if(isset($reussite)) { ?>
    <div class="message"><?php if($reussite == 1) { echo "Merci d'avoir participé !"; } elseif ($reussite == 2) { echo "Une erreur est survenue";} ?></div>
    <?php } ?>  

      <form action="formulaire.php" class="contain" method="post" <?php if(isset($reussite) && $reussite==1 ) echo"style= display:none;" ?>>
        <fieldset>
            <h2>Apprenons à te connaître...</h2>

            <div class="input">
                <label <?php if(array_key_exists('first_name', $erreurrrr)) echo $css_lab_err;?>>
                Quel est ton prénom ?</label>
                <input type="text" name="first_name" value="<?php if (isset($first_name)) echo $first_name;?>">
            </div>

            <!-- Si tu as répondu Oui, tu peux choisir un métier --> 
            <div  class="input">
                <label <?php if(array_key_exists('last_name',$erreurrrr)) echo $css_lab_err; ?>>
                Et ton nom de famille ?</label>
                <input type="text" name="last_name" value="<?php if (isset($last_name)) echo $last_name;?>">
            </div>

            <div>
                <label <?php if(array_key_exists('sex',$erreurrrr)) echo $css_lab_err; ?>>
                T'es une fille ou un gars ?</label>
                <div class="radio"><input type="radio" name="sex" value="0" <?php if (isset($sex) AND $sex==0) echo "checked";?>>Fille</div>
                <div class="radio"><input type="radio" name="sex" value="1"<?php if (isset($sex) AND $sex==1) echo "checked";?>>Garçon</div>
            </div>

            <div class="input">
                <label  <?php if(array_key_exists('age',$erreurrrr)) echo $css_lab_err; ?>>
                Et sinon t'as quel âge?</label>
                <input type="number" name="age" id="age" value="<?php if (isset($age)) echo "$age";?>" placeholder="--" max="120" min="15">
            </div>

            <div>
                <label <?php if(array_key_exists('home',$erreurrrr)) echo $css_lab_err; ?>>
                Habites tu encore chez tes parents ?</label>
                <div class="radio"><input type="radio" name="home" value="0" <?php if (isset($home) AND $home==0) echo "checked";?>>Oui</div>
                <div class="radio"><input type="radio" name="home" value="1"<?php if (isset($home) AND $home==1) echo "checked";?>>Non</div>
            </div>

            <div class="input">
                <label <?php if(array_key_exists('postal_code',$erreurrrr)) echo $css_lab_err; ?>>
                Où exactement?</label>
                <input type="text" name="postal_code" value="<?php if (isset($postal_code)) echo $postal_code; ?>" placeholder="Tape ton code postal?">
            </div>

            <div>
                <label <?php if(array_key_exists('study',$erreurrrr)) echo $css_lab_err; ?>>
                As tu terminé tes études ?</label>
                <div class="radio"><input type="radio" name="study" onChange="test_study();" value="0" <?php if (isset($study) AND $study==0) echo "checked";?>>Oui</div>
                <div class="radio"><input type="radio" name="study" onChange="test_study();" value="1"<?php if (isset($study) AND $study==1) echo "checked";?>>Non</div>
            </div>

              <!-- Si tu as répondu Oui, tu peux choisir un métier --> 
            <div id="study_oui">
                <label <?php if(array_key_exists('home',$erreurrrr)) echo $css_lab_err; ?>>
                Es tu...</label>
                <div class="radio"><input type="radio" name="work" value="0" <?php if (isset($work) AND $work==0) echo "checked";?>>En CDD ?</div>
                <div class="radio"><input type="radio" name="work" value="1"<?php if (isset($work) AND $work==1) echo "checked";?>>En CDI ?</div>
                <div class="radio"><input type="radio" name="work" value="2" <?php if (isset($work) AND $work==2) echo "checked";?>>En intérim ?</div>
                <div class="radio"><input type="radio" name="work" value="3"<?php if (isset($work) AND $work==3) echo "checked";?>>A ton compte ?</div>
                <div class="radio"><input type="radio" name="work" value="4" <?php if (isset($work) AND $work==4) echo "checked";?>>Au chomâge ?</div>
                <div class="radio"><input type="radio" name="work" value="5"<?php if (isset($work) AND $work==5) echo "checked";?>>Autre</div>
            </div>
                <!-- Sinon choisis le niveau d'étude --> 
            <div id="study_non">
                <label <?php if(array_key_exists('study_wh',$erreurrrr)) echo $css_lab_err; ?>>
                Es tu...</label>
                <div class="radio"><input type="radio" name="stud_wh" onChange="test_niv_etude();" value="0" <?php if (isset($stud_wh) AND $stud_wh==0) echo "checked";?>>Au collège ?</div>
                <div class="radio"><input type="radio" name="stud_wh" onChange="test_niv_etude();" value="1"<?php if (isset($stud_wh) AND $stud_wh==1) echo "checked";?>>Au lycée ?</div>
                <div class="radio"><input type="radio" name="stud_wh" onChange="test_niv_etude();" value="2" <?php if (isset($stud_wh) AND $stud_wh==2) echo "checked";?>>Etudiant?</div>
            <br/>
                <label <?php if(array_key_exists('place',$erreurrrr)) echo $css_lab_err; ?>>
                Dans le...</label>
                <div class="radio"><input type="radio" name="place" value="0" <?php if (isset($place) AND $place==0) echo "checked";?>>Privée</div>
                <div class="radio"><input type="radio" name="place " value="1"<?php if (isset($place) AND $place==1) echo "checked";?>>Pubic</div>
            </div>
                <!-- FinSi--> 
              <!-- Si tu es étudiante 1 et 2--> 
            <div id="etudiant_sup">
                <label <?php if(array_key_exists('stud_place',$erreurrrr)) echo $css_lab_err; ?>>
                Etudiant en...</label>
                <div class="radio"><input type="radio" name="stud_place" value="0" <?php if (isset($stud_place) AND $stud_place==0) echo "checked";?>>BTS/DUT ?</div>
                <div class="radio"><input type="radio" name="stud_place" value="1"<?php if (isset($stud_place) AND $stud_place==1) echo "checked";?>>Master/ ou plus ?</div>
                <div class="radio"><input type="radio" name="stud_place" value="2" <?php if (isset($stud_place) AND $stud_place==2) echo "checked";?>>Autre école</div>
            <br/>
                <label <?php if(array_key_exists('stud_work',$erreurrrr)) echo $css_lab_err; ?>>
                Travailles tu en marge de tes études...</label>
                <div class="radio"><input type="radio" name="stud_work" value="0" <?php if (isset($stud_work) AND $stud_work==0) echo "checked";?>>Oui</div>
                <div class="radio"><input type="radio" name="stud_work" value="1"<?php if (isset($stud_work) AND $stud_work==1) echo "checked";?>>Non</div>
            </div>
              <!-- Fin Si tu es étudiante 1 et 2--> 
          
             
              <div>
                <input type="submit" name="submit" value="Envoyer">
              </div>
            <!-- Fin Si--> 
        </fieldset>
      </form>
    </div>

    <div class="resultat">
    <?php  ?>
    
    </div>

    <?php if(isset($reussite) && $reussite==1 ) { ?>
    <div class="contain">
        
        Statistiques publiques : <br/>
        <?php 
        $donnees = $bdd->query('SELECT COUNT(*) AS id FROM results');
        $donnees = $donnees->fetch();
        $nbr_sondes = $donnees['id'];

        $donnees = $bdd->query('SELECT COUNT(*) AS garcons FROM results WHERE sex=1 '); // tt les garcons
        $donnees = $donnees->fetch();
        $nbr_garcons = $donnees['garcons'];
        $nbr_filles = $nbr_sondes - $nbr_garcons;
        $age = 0;
        $reponse = $bdd->query("SELECT * FROM results"); // Requête SQL  
            while ($donnees = $reponse->fetch() ) {
        
        $age = $age + $donnees['age'];
        
    }
    $age_global = $age/$nbr_sondes;
    $age_global = round($age_global);
        ?>
        <label><?php echo"Il y a $nbr_sondes sondés"; ?></label><br/>
        <label><?php echo"Dont $nbr_garcons garçons et $nbr_filles filles"; ?></label><br/>
        <label><?php echo"L'age moyen des sondés est de $age_global"; ?></label>

    </div>
    <?php } ?>
</div>




<script type="text/javascript">
    var study = document.getElementsByName('study');

    var study_oui = document.getElementById('study_oui');
    var study_non = document.getElementById('study_non');

    var niv_etude = document.getElementsByName('stud_wh');
    var etudiant_sup = document.getElementById('etudiant_sup');

function test_study() { 

     

     if (study[0].checked) {  // j'ai terminé mes etudes
     study_oui.style.display = 'inline-block';
     study_non.style.display = 'none';
     etudiant_sup.style.display = 'none';
     } 
     if (study[1].checked) { // je n'ai PAS terminé mes études
     study_non.style.display = 'inline-block';
     study_oui.style.display = 'none';
     } 
}

function test_niv_etude(){
     
     if (niv_etude[2].checked) { // Si je suis étudiant
     etudiant_sup.style.display = 'inline-block';
     } 
     else {
     etudiant_sup.style.display = 'none';
     console.log("niv 0 ou 1 checked");
     } 
}





</script>


  </body>
</html>