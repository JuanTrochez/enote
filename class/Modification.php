<?php

class Modification {
    private $id;
    private $date;
    private $change_id;
    private $table_name;
    private $author_id;

    
    public function __construct() {
        
    }

    function getId() {
        return $this->id;
    }

    function getDate() {
        return $this->date;
    }

    function getChange_id() {
        return $this->change_id;
    }

    function getTable_name() {
        return $this->table_name;
    }

    function getAuthor_id() {
        return $this->author_id;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setDate($date) {
        $this->date = $date;
    }

    function setChange_id($change_id) {
        $this->change_id = $change_id;
    }

    function setTable_name($table_name) {
        $this->table_name = $table_name;
    }

    function setAuthor_id($author_id) {
        $this->author_id = $author_id;
    }

    public function insertNewModif($bdd, $change_id, $table_name, $author_id) {
       $newModif = new Modification();
       $date = date("Y-m-d");
       $newModif->setDate($date);
       $newModif->setChange_id($change_id);
       $newModif->setTable_name($table_name);
       $newModif->setAuthor_id($author_id);

       $addmodif = $bdd->prepare("INSERT INTO modification(date, change_id, table_name, author_id) "
                . "values (:date, :change, :table, :author)");
        $addmodif->execute(array(
           ":date" => $newModif->date,
           ":change" => $newModif->change_id,
           ":table" => $newModif->table_name,
           ":author" => $newModif->author_id
        ));
    }
}
