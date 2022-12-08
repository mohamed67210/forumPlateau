<?php

namespace Model\Entities;

use App\Entity;

final class User extends Entity
{
    private $id;
    private $pseudo;
    private $mail;
    private $password;
    private $role;
    private $dateCreation;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    public function getId()
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }
    public function setPseudo($pseudo)
    {
        $this->pseudo = $pseudo;
        return $this;
    }

    public function getMail()
    {
        return $this->mail;
    }
    public function setMail($mail)
    {
        $this->mail = $mail;
        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
    public function setDateCreation($date)
    {
        $this->dateCreation = $date;
        return $this;
    }
    public function getIsBanish(){
        return $this->isBanish;
    }
    public function setIsBanish($isBanish){
        $this->isBanish = $isBanish;
        return $this;
    }
    public function hasRole($role)
    {
        if ($this->role == $role) {
            return $this->role;
        } else {
            return false;
        }
    }

    


    public function __toString()
    {
        return $this->getPseudo();
    }
}
