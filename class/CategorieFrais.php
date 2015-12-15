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
    
    public static function getCategorieById($bdd, $id) {
        $req = $bdd->prepare("SELECT * FROM categorie_frais WHERE id = :id");
        $req->execute(array(
            ":id"   =>  $id
        ));
        
        $cloneFrais = new CategorieFrais();
        while ($array = $req->fetch()) {
            $cloneFrais->setId($array['id']);
            $cloneFrais->setName($array['name']);
        }
        
        return $cloneFrais;
    }
    
    public static function getAllCategorie($bdd)
    {
        return ($bdd->query('SELECT * FROM categorie_frais'));
    }

}
