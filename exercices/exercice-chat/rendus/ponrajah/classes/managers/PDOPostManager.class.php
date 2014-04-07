<?php
/**
 * Created by PhpStorm.
 * User: Ayrton
 * Date: 23/03/14
 * Time: 20:31
 */

require_once("PDOManager.class.php");

class PDOChatManager {

    function getPost(){

        $PDOManager = new PDOManager;
        $pdo = $PDOManager->newPdo();



        $query = $pdo->prepare("SELECT post.id,post,date_post,pseudo FROM post LEFT JOIN user ON id_user = user.id   LIMIT 100");
        $query->execute();

        $post = $query->fetchAll();


        return $post;

    }

    function sendPost($id_user,$post){
        $PDOManager = new PDOManager;
        $pdo = $PDOManager->newPdo();

        $query = $pdo->prepare("INSERT INTO post(id_user, post, date_post) VALUES(:id_user, :post, NOW())");
        $query->execute(array(
            'id_user' => $id_user,
            'post' => $post
        ));
    }

    public function showPost($list_post){

        $affichage = '<ol>';


            foreach($list_post as $post){

                $affichage .= '<li><b>' . $post['pseudo'] . '('.$post['date_post'].'):   </b>' . $post['post'] . '</li></br>';


            }


            $affichage .= '</ol>';
            return $affichage;
        }

    public function jsonPost(){
        $post = $this->getPost();
        $affichage = $this->showPost($post);

        return json_encode(utf8_encode($affichage));

    }

} 