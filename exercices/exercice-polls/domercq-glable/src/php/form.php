<?php

	/*Netoyage des espaces*/
      function clear_space($data)
    {
		$data['first_name'] = strip_tags(trim($data['first_name']));
		$data['last_name'] = strip_tags(trim($data['last_name']));
		$data[''] = (int)$data['age']; 
		/*$data['email'] = strip_tags(trim($data['email']));*/
      
      return $data; 
    }

    /*Checkage du formualire*/
    function check_form()
    {
      $errors = array();
      if (empty($_POST['first_name']))    $errors['first_name'] = 1;
      if (empty($_POST['last_name']))     $errors['last_name'] = 1;
      if (empty($_POST['sex']))           $errors['sex'] = 1;
      if (empty($_POST['age']))           $errors['age'] = 1;
      if (empty($_POST['home']))          $errors['home'] = 1;
      if (empty($_POST['postal_code']))   $errors['postal_code'] = 1;
      if (empty($_POST['study']))         $errors['study'] = 1;
      /*if (empty($_POST['work']))          $errors['work'] = 1;
      if (empty($_POST['study_wh']))      $errors['study_wh'] = 1;
      if (empty($_POST['place']))         $errors['place'] = 1;
      if (empty($_POST['stud_place']))    $errors['stud_place'] = 1;
      if (empty($_POST['stud_work']))     $errors['stud_work'] = 1;
      */

      global $erreurrrr;

       // Affichage des erreurs
      foreach($errors as $erreur => $type_erreur)
      {
          $erreurrrr[$erreur] = $type_erreur;
       }
      
      
    }

     

      /*
      //first_name : remplir, min, max
      if (empty($_POST['first_name']))
        $errors['first_name'] = 'Tu as oubliés de remplir ton prénom';
      else if (strlen($_POST['first_name']) < 2)
        $errors['first_name'] = 'Un prénom contient plus de caractère...';
      else if (strlen($_POST['first_name']) > 30)
        $errors['first_name'] = 'Un prénom aussi grand ça n\'existe pas...';
		if (empty($_POST['last_name']))
       		$errors['last_name'] = 'Tu as oubliés de remplir ton nom';
		else if (strlen($_POST['last_name']) < 2)
			$errors['last_name'] = 'Un nom contient plus de caractère...';
		else if (strlen($_POST['last_name']) > 30)
			$errors['last_name'] = 'Un nom aussi grand ça n\'existe pas...';

      /*Age : Minim, max, remplir*/
     /* if (empty($_POST['age']))
        $errors['age'] = 'Donnes nous ton âge !';
      else if ($_POST['age'] < 6)
        $errors['age'] = 'Tu es beaucoup trop jeune pour être sur le grand internet, retourne dormir!';

      /* Sex */
  /*    if (empty($_POST['sex']))
        $errors['sex'] = 'Donnes nous ton sexe !';
      
      /* Sex */
   /*   if (empty($_POST['age']))
        $errors['age'] = 'Donnes nous ton age !';
      

      
    }
    */
?>