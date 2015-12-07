<?php

include_once "Frais.php";

class Note {
    private $id;
    private $name;
    private $total;
    private $date;
    private $user;
    private $statut;


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

    public function setTotal($value)
    {
        $this->total = $value;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setDate($value)
    {
        $this->date = $value;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function setUser($value)
    {
        $this->user = $value;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setStatut($value)
    {
        $this->statut = $value;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    //retourne toutes les notes en base de données
    public function getAllNotes($bdd) {
        $listNotes = $bdd->query("SELECT * FROM note_frais");

        return $listNotes->fetchAll();
    }
    
    public function getNotesByUser($bdd, $uid) {
        $listNotes = $bdd->prepare("SELECT * FROM note_frais WHERE user_id = :uId");
        $listNotes->execute(array(
            ":uId"  =>  $uid
        ));

        return $listNotes->fetchAll();

    }

    //recupère les frais correspondant a la note
    public function getListFrais($bdd) {
        getFraisByNote($bdd, $this->id);
    }

}
