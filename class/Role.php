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
        $roleTable = $bdd->query('SELECT * FROM role');
        return $roleTable;
    }
    
    public function _destruct(){
        
    }
    
}

