<?php
/**
 * Created by JetBrains PhpStorm.
 * User: ayrton
 * Date: 18/02/13
 * Time: 15:04
 * To change this template use File | Settings | File Templates.
 */
class User
{
    private $id;
    private $pseudo;
    private $password;
    private $date_registration;

    function __construct($id, $pseudo, $password, $date_registration)
    {
        $this->id = $id;
        $this->date_registration = $date_registration;
        $this->pseudo = $pseudo;
        $this->password = $password;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setpseudo($pseudo)
    {
        $this->pseudo = $pseudo;
    }

    public function getpseudo()
    {
        return $this->pseudo;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setDateRegistration($date_registration)
    {
        $this->date_registration = $date_registration;
    }

    public function getDateRegistration()
    {
        return $this->date_registration;
    }
}
