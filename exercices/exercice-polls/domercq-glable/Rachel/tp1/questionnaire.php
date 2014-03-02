<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>SURVEY</title>
  	<link rel="stylesheet" href="src/css/reset.css">
  	<link rel="stylesheet" href="src/css/questionnaire.css">

  </head>

  <body>

    <div class="container-form">
      <form action="#" method="post">
        <fieldset>

          <div class="case-title-1">
            <div class="case-title-2">
              <h2 class="un">APPRENONS À TE CONNAITRE</h2>
            </div>
          </div>

              <div class="contain">
                <div class="contain2">
                 <div>
                  <label for="name">Quel est ton nom ?</label>
                  <input type="text" name="name" value="" placeholder="Nom">
                </div>

                <div>
                  <label for="sexe">Fille ou garçon ?</label>
                  <input type="radio" name="genre" value="Fille">Fille
                  <input type="radio" name="genre" value="Fille">Garçon
                </div><br>

                <div>
                  <label for="age">Quel est ton âge?</label>
                  <input value="" type="number" name="age" id="age" placeholder="age" max="99" min="15">
                </div>

                <div>
                  <label for="adress">Quel est ton code postal?</label>
                  <input value="" type="text" name="adress" id="adress" placeholder="Code postal">
                </div>

                <div>
                  <label for="etudes">As-tu terminer tes études ?</label>
                  <input type="radio" name="reponse" value="yes">Oui 
                  <input type="radio" name="reponse" value="no">Non
                </div><br>

                <div>
                  <label for="etudes">Es-tu : </label>
                  <input type="radio" name="etudes" value="college">au Collège ? 
                  <input type="radio" name="etudes" value="lycee">au Lycée ?
                  <input type="radio" name="etudes" value="etudiant">Étudiant ?
                </div>

                </div>
              </div>
          <div class="case-title-1">
            <div class="case-title-2">
              <h2 class="deux">TON AVIS </h2>
            </div>
          </div>
              <div class="contain">
                <div class="contain2">
                <div>
                  <label>Quels promotions a tu préférés ?</label>
                  <input type="checkbox" name="promotion" value="P2017">P2017
                  <input type="checkbox" name="promotion" value="P2016">P2016
                  <input type="checkbox" name="promotion" value="P2016">P2016
                </div><br>
                </div>
              </div>
              
              <div class="contain-submit">
                <div>
                  <input type="submit" name="submit" value="VALIDER" class="btn-success">
                </div>
              </div>
        </fieldset>

      </form>
    </div>
  </body>
</html>
