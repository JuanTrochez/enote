<?php

class Role{
    
    private $name;
    private $id;
    
    public function _construct(){
        
    }
    
    public function setName($nameRole){
        $this->name = $nameRole;
    }
    
    public function getName(){
        return $this->name;
    }
    
    public function setId($id){
        $this->id = $id;
    }
    
    public function getId(){
        return $this->id;
    }
    
    public function getAllRole($bdd){
        return ($bdd->query('SELECT * FROM role'));
    }
    
    public function _destruct(){
        
    }
    
}

