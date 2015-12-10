<?php

include_once '/function/cookie.php';
include_once 'Note.php';

class User {
    //put your code here
    private $id;
    private $login;
    private $password;
    private $name;
    private $role;
    private $devise;

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

    public function setLogin($loginEnvoye)
    {
        $this->login = $loginEnvoye;
    }

    public function getLogin()
    {
        return $this->login;
    }

    public function setPassword($passwordEnvoye)
    {
        $this->password = $passwordEnvoye;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setName($value)
    {
        $this->name = $value;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setRole($value)
    {
        $this->role = $value;
    }

    public function getRole()
    {
        return $this->role;
    }
    
    public function setDevise($value)
    {
        $this->devise = $value;
    }

    public function getDevise()
    {
        return $this->devise;
    }
    
    public function getAllUser($bdd) {
        $req = $bdd->query("SELECT * FROM user");
        
        return $req->fetchAll();
    }

    //retourne les notes de l'utilisateur en base de données
    public function getNotes($bdd) {
        $note = new Note();
        $listNotes = $note->getNotesByUser($bdd, $this->id);

        return $listNotes;
    }

    public function connect($bdd, $remember)
    {
       $isConnected = false;
       $connected = $bdd->prepare('SELECT * FROM user WHERE login = :login AND password = :password LIMIT 1');
       $connected->execute(array(':login' => $this->login, ':password' => $this->password));

       //verifie que la requete renvoie une ligne
       if ($connected->rowCount() == 1) {
            $u = $connected->fetchAll();
            $user = new User();
            $user->setId($u[0]['id']);
            $user->setLogin($u[0]['login']);
            $user->setPassword($u[0]['password']);
            $user->setName($u[0]['name']);
            $user->setRole($u[0]['role_id']);
            $user->setDevise($u[0]['devise_id']);
            $_SESSION['user'] = serialize($user);

           //s'il a coché la case 'se souvenir'
            if($remember){
                cookie($this->login, $this->password, true);
            }

            $isConnected = true;
       }
       return $isConnected;
    }
    
    public function deleteUserById($bdd, $id) {
        $req = $bdd->prepare("DELETE FROM user WHERE id = :id");
        $req->execute(array(
            ":id"   =>  $id
        ));
        
    }

    function __destruct()
    {

    }
}
