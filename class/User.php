<?php

class User {
    //put your code here
    private $login;
    private $password;
    
    function _construct()
    {
        
    }
    
    public function setLogin($loginEnvoye)
    {
        $this->login = $loginEnvoye;
    }
    
    public function setPassword($passwordEnvoye)
    {
        $this->password = $passwordEnvoye;
    }
    
    public function getLogin()
    {
        return $this->login;
    }
    
    public function getPassword()
    {
        return $this->password;
    }
    
    public function connect($bdd)
    {
        
       $connected = $bdd->prepare('SELECT * FROM user WHERE login = :login AND password = :password');      
       $isConnected = $connected->execute(array(':login' => $this->login));
       
       if($isConnected == true)
       {
           $isConnected = $connected->execute(array(':password' => $this->password));
       }
       return $isConnected;
    }

    function __destruct() 
    {
        
    }
}
