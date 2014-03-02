<?php

// Description : Classe d'initialisation des éléments HTML

class Affichage {

	public function __construct(){
    	$this->Meta();
    	$this->Header();
    	(isset($_GET['page'])) ? $this->Page($_GET['page']) : $this->Page('accueil');
        $this->Footer();
	}

	private function Meta(){
		include ("./includes/meta.inc.php");
	}

	private function Header(){
		include ("./includes/header.inc.php");
	}

	private function Page($value){
		switch ($value){
			case 'accueil'                  : include ("./pages/accueil.php"); 			break;        
			case 'dieudonnee'               : include ("./pages/big_survey.php"); 		break;      
			case 'inscription'              : include ("./pages/subscribe.php"); 		break;        
			case 'login'                    : include ("./pages/login.php"); 			break;                
			case 'deconnexion'              : include ("./pages/disconnect.php"); 		break;      
			case 'liste_des_questionnaires' : include ("./pages/list_survey.php"); 		break;    
			case 'survey'                   : include ("./pages/survey.php"); 			break;              
			case 'survey_add'               : include ("./pages/survey_add.php"); 		break;      
			case 'need_connect'             : include ("./pages/need_connect.php"); 	break;  
			case 'survey_delete'            : include ("./pages/survey_delete.php"); 	break;
			default                         : include ("./pages/accueil.php"); 			break;
		}
	}
    
    private function Footer(){
		include ("./includes/footer.inc.php");
	}
}

?>