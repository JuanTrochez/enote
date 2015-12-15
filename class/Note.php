<?php

include_once "Frais.php";

class Note {
    private $id;
    private $name;
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
    
    //Rentrer une nouvelle note.
    public function insertNewNote($bdd){
        $addnote = $bdd->prepare("INSERT INTO note_frais(name, date, user_id, statut_id) "
                . "values (:name, :date, :user, :statut)");
        $addnote->execute(array(
           ":name" => $this->name,
           ":date" => $this->date,
           ":user" => $this->user,
           ":statut" => $this->statut
        ));
    }

    //recupère les frais correspondant a la note
    public function getListFrais($bdd) {
        return Frais::getFraisByNote($bdd, $this->id);
    }
    public static function getNoteById($bdd, $id){
        $note = $bdd->prepare('SELECT * FROM note_frais WHERE id = :id LIMIT 1');
        $note->execute(array(
            ':id' => $id
        ));
        
        $array = $note->fetch();
        
        $CloneNote = new Note();
        $CloneNote->setDate($array['date']);
        $CloneNote->setId($array['id']);
        $CloneNote->setName($array['name']);
        $CloneNote->setStatut($array['statut_id']);
        $CloneNote->setUser($array['user_id']);
        
        return $CloneNote;
    }
    
    public static function getMontantTotal($bdd, $nid, $tauxDeviseUser) {
        
        $CloneNote = Note::getNoteById($bdd,$nid);
        $allFraisFromThisNote = $CloneNote->getListFrais($bdd);
        $SommeDesMontants = 0;
        foreach($allFraisFromThisNote as $frais)
        {
            $CloneDevise = Devise::getDeviseById($bdd, $frais['devise_id']);
            
            if($frais['categorie_id'] == 4)
            {
                $SommeDesMontants -= Devise::getValueOfChangedDevise($frais['montant'], $CloneDevise->getTaux(),$tauxDeviseUser);
            }else{
                $SommeDesMontants += Devise::getValueOfChangedDevise($frais['montant'], $CloneDevise->getTaux(),$tauxDeviseUser);
            }
            
        }
        
        
        return $SommeDesMontants;
    }
    
    //recupére le nom d'une note.
    public function getNameNote($bdd, $nid) {
        $getname = $bdd->prepare("SELECT name from note_frais WHERE id= :nid");
        $getname->execute(array(
            ":nid" => $nid
        ));
        $name = $getname->fetch();
        return $name[0];
    }
    
    //Modification du nom d'une note.
    public function updateNote($bdd, $nid, $namenote, $satutnote) {
        $getname = $bdd->prepare("UPDATE `note_frais` SET `name`= :name, `statut_id`= :statut WHERE id= :nid");
        $getname->execute(array(
            ":name" => $namenote,
            ":statut" => $satutnote,
            ":nid" => $nid
        ));
    }
    
    public function deleteNoteById($bdd,$nid) {
        $delnote = $bdd->prepare("DELETE FROM `note_frais` WHERE `id`= :nid");
        return $delnote->execute(array(
            ":nid" => $nid
        ));
    }
}
