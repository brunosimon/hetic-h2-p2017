<?php

class PDOManager
{
    private $pdo_usr = "root";
    private $pdo_pwd = "root";
    private $pdo_db = "exercice-chat-ponrajah";

    public function newPdo(){
        try
        {
            $pdo = new PDO('mysql:host=localhost;dbname=' . $this->pdo_db, $this->pdo_usr, $this->pdo_pwd);
            return $pdo;
        }
        catch (Exception $e)
        {

            die('Error : ' . $e->getMessage());
        }
    }
}

