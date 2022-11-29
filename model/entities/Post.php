<?php

namespace Model\Entities;

use App\Entity;

final class Post extends Entity
{

    private $id;
    private $contenue;
    private $dateCreation;
    private $user;
    private $topic;

    public function __construct($data)
    {
        $this->hydrate($data);
    }

    /**
     * Get the value of id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of contenue
     */
    public function getContenue()
    {
        return $this->contenue;
    }

    /**
     * Set the value of contenue
     *
     * @return  self
     */
    public function setContenue($contenue)
    {
        $this->contenue = $contenue;

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
    public function getUser()
    {
        return $this->user;
    }
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }
    public function getTopic()
    {
        return $this->topic;
    }
    public function setTopic($topic)
    {
        $this->topic = $topic;
        return $this;
    }
}
