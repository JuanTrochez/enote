<?php

class Statut {
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
    
    public function getAll($bdd) {
        $statut = $bdd->query("SELECT * FROM statut_note");
                
        return $statut->fetchAll();
    }

    public function getStatutById($bdd) {
        $statut = $bdd->prepare("SELECT * FROM statut_note WHERE id = :sId");
        
        $statut->execute(array(
            ":sId"      =>  $this->id
        ));
                
        return $statut->fetch();
    }
}
