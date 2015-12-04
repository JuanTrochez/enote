<?php

class Note {
    private $name;
    private $total;
    private $date;
    private $user;
    private $statut;
    
    
    function __construct()
    {
        
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

}
