<?php
include_once "Modification.php";
include_once "User.php";

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
        $this->date = $value;
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
    
    public static function getFraisByNote($bdd, $noteId) {
        $allFrais = $bdd->prepare("SELECT * FROM frais WHERE note_id = :noteid");
        $allFrais->execute(array(
            ":noteid"   =>  $noteId
        ));

        return $allFrais->fetchAll();

    }
    
    public function insertFrais($bdd)
    {
        $req = $bdd->prepare("INSERT INTO frais(image, date, description, montant, devise_id, note_id, categorie_id) VALUES(:image, :date, :description, :montant, :devise_id, :note_id, :categorie_id)");
        $req->execute(array(
            ':image' => $this->image,
            ':date' => $this->date,
            ':description' => $this->description,
            ':montant' => $this->montant,
            ':devise_id' => $this->devise,
            ':note_id' => $this->note,
            ':categorie_id' => $this->categorie
        ));
        $req->closeCursor();
    }
    
    public function upDateFrais($bdd)
    {
        $req = $bdd->prepare("UPDATE frais SET image = :image, date = :date, description = :description, "
                . "montant = :montant, devise_id = :devise_id, note_id = :note_id, categorie_id = :categorie_id "
                . "WHERE id = :id");
        
        $req->execute(array(
            ':image' => $this->image,
            ':date' => $this->date,
            ':description' => $this->description,
            ':montant' => $this->montant,
            ':devise_id' => $this->devise,
            ':note_id' => $this->note,
            ':categorie_id' => $this->categorie,
            ':id' => $this->id
        ));
        $req->closeCursor();
        
        $table_name = "frais";
        $user = unserialize($_SESSION['user']);
        $author_id = $user->getId();
        $nid = $this->id;
        Modification::insertNewModif($bdd, $nid, $table_name, $author_id);
    }
    
    public function deleteFraisById($bdd, $id) {
        $req = $bdd->prepare('DELETE FROM frais WHERE id = :id');
        
        return $req->execute(array(
            ":id" => $id
        ));
    }
    
    public function getFraisById($bdd, $id)
    {
        $req= $bdd->prepare('SELECT * FROM frais WHERE id = :id LIMIT 1');
        $req->execute(array(
            ':id' => $id
        ));
        return $req->fetchAll();
    }
    
    public static function getCoutByCategorieId($bdd, $id) {
        $req = $bdd->prepare("SELECT SUM(montant) as totalCat, categorie_id, devise_id FROM frais WHERE categorie_id = :id");
        $req->execute(array(
            ":id"   =>  $id
        ));
        return $req->fetch();
    }
    
    public static function getCoutParMois($bdd, $mois) {
        $req = $bdd->prepare("SELECT SUM(montant) as totalMois, devise_id FROM frais WHERE month(date) = :mois");
        $req->execute(array(
            ":mois" => $mois
        ));
        
        return $req->fetch();
    }
    
}
