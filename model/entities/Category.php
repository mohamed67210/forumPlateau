<?php

namespace Model\Entities;

use App\Entity;

final class Category extends Entity
{

    private $id;
    private $nomCategory;

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

    public function getNomCategory()
    {
        return  $this->nomCategory;
    }
    public function setNomCategory($nomCategory)
    {
        $this->nomCategory = $nomCategory;
    }
}
