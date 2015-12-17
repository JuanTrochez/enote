<?php

class Devise {
    private $id;
    private $name;
    private $signe;
    private $taux;
    
    
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
    
    public function getSigne()
    {
        return $this->signe;
    }
    
    public function setSigne($signe)
    {
        $this->signe = $signe;
    }
    
    public function getTaux()
    {
        return $this->taux;
    }
    
    public function setTaux($taux)
    {
        $this->taux = $taux;
    }
    
    public static function getDeviseById($bdd, $id) {
        
        $Devise = new Devise();
        $devise = $bdd->prepare("SELECT * FROM devise WHERE id = :did LIMIT 1");
        $devise->execute(array(
            ':did' => $id
        ));
        
        while($array = $devise->fetch())
        {
            $Devise->setId($array['id']);
            $Devise->setName($array['name']);
            $Devise->setSigne($array['signe']);
            $Devise->setTaux($array['taux']);
        }
        
        return $Devise;
    }
    
    public function getAllDevise($bdd)
    {
        return ($bdd->query('SELECT * FROM devise'));
    }
    
    public static function getValueOfChangedDevise($value,$fromDeviseTaux, $toDeviseTaux)
    {
        $total = ($value * $fromDeviseTaux) / $toDeviseTaux;
        return round($total, 2);
    }
    
}
