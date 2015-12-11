<?php

class CategorieFrais {
    private $id;
    private $name;

    function __construct()
    {

    }

    public function setId($value)
    {
        $this->id = $value;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }
    
    public function getAllCategorie($bdd)
    {
        $cateTable = $bdd->query('SELECT * FROM categorie_frais');
        return $cateTable;
    }

}
