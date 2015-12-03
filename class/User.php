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
       $isConnected = false;
       $connected = $bdd->prepare('SELECT * FROM user WHERE login = :login AND password = :password LIMIT 1');      
       $connected->execute(array(':login' => $this->login, ':password' => $this->password));
       
       if ($connected->rowCount() == 1) {
           $isConnected = true;
       }       
       return $isConnected;
    }

    function __destruct() 
    {
        
    }
}
