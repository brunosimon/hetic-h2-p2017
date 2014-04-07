<?php


require_once("PDOManager.class.php");
require_once(__DIR__."/../entities/User.class.php");



class PDOUserManager
{

    private $message;

    public function getMessage()
    {
        return $this->message;
    }

    public function authentication($pseudo, $password){

            $PDOManager = new PDOManager;
            $pdo = $PDOManager->newPdo();

            $query = $pdo->prepare("SELECT * FROM user WHERE pseudo = ? ");
            $query->execute(array($pseudo));
            $data = $query->fetchAll();

            if(count($data) == 0){
                $this->message = "Adresse pseudo incorrecte";
            }
            else{
                $row = $data[0];

                if(sha1($password) != $row["password"]){
                    $this->message = "Mot de passe incorrecte";

                }
                else{



                    $user = new User($row["id"], $row["pseudo"], $row["password"], $row["date_registration"]);
                    header("location: index.php");
                    return $user;



                }
            }
    }





   public function registration($pseudo, $password, $confirmation){



           $PDOManager = new PDOManager;
           $pdo = $PDOManager->newPdo();



           $query = $pdo->prepare('SELECT pseudo FROM user WHERE  pseudo = :pseudo ');
           $query->execute(array(
               'pseudo' => $pseudo
           ));

           $result = $query->fetchAll();

           if(count($result) > 0){
               foreach($result as $row){

                   if($pseudo == $row["pseudo"]){

                       $this->message = "Le pseudo est deja utilisé";


                   }
               }
           }
           elseif(!preg_match("/^[a-zA-Z0-9_]{4,}$/", $password))
           {
               $this->message = "Votre mot de passe doit contenir au moins 4 caracteres";
           }
           elseif( $password != $confirmation){

               $this->message= "Les mots de passes sont différents";


           }
           else{

              $query1 = $pdo->prepare('INSERT INTO user(pseudo, password) VALUES(:pseudo, :password)');
              $query1->execute(array(
                   'pseudo' => $pseudo,
                   'password' => sha1($password),

              ));

               $this->message = "Inscriptio reussie ! Vous pouvez des à présent vous connecter";





           }
    }
}
