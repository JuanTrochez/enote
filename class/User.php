<?php

include_once '/function/cookie.php';

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
    
    public function connect($bdd, $remember)
    {
       $isConnected = false;
       $connected = $bdd->prepare('SELECT * FROM user WHERE login = :login AND password = :password LIMIT 1');      
       $connected->execute(array(':login' => $this->login, ':password' => $this->password));
       
       //verifie que la requete renvoie une ligne
       if ($connected->rowCount() == 1) {
            $u = $connected->fetchAll();
           
           //s'il a coché la case 'se souvenir'
            if($remember){
                $_SESSION['user'] = $u[0];
                cookie($this->pseudo, $this->password);
            }else{
                $_SESSION['user'] = $u[0];
            }            
            
            $isConnected = true;
       }       
       return $isConnected;
    }

    function __destruct() 
    {
        
    }
}
