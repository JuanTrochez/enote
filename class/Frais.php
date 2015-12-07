<?php

class Frais {
    private $id;
    private $description;
    private $date;
    private $montant;
    private $image;
    private $devise;
    private $note;
    private $categorie;

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

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDate($value)
    {
        $this->Date = $value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setMontant($value)
    {
        $this->montant = $value;
    }

    public function getMontant()
    {
        return $this->montant;
    }

    public function setImage($value)
    {
        $this->image = $value;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setDevise($value)
    {
        $this->devise = $value;
    }

    public function getDevise()
    {
        return $this->devise;
    }

    public function setNote($value)
    {
        $this->note = $value;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function setCategorie($value)
    {
        $this->categorie = $value;
    }

    public function getCategorie()
    {
        return $this->categorie;
    }

    public function getFraisByNote($bdd, $noteId) {
        $allFrais = $bdd->prepare("SELECT * FROM frais WHERE note_id = :noteid");
        $allFrais->execute(array(
            ":noteid"   =>  $noteId
        ));

        return $allFrais->fetch();

    }

}