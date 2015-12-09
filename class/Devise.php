<?php

class Devise {
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
    
    public function getDeviseById($bdd, $id) {
        $devise = $bdd->prepare("SELECT name FROM devise WHERE id = :did");
        
        $devise->execute(array(
            ':did'  =>  $id
        ));
        $aDevise = $devise->fetch();
        return $aDevise[0];
    }
}
