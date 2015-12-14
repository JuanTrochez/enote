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
    private $mail;

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
    
    public function setEmail($email)
    {
        $this->mail = $email;
    }
    
    public function getEmail()
    {
        return $this->mail;
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
            $user->setEmail($u[0]['mail']);
            $user->setName($u[0]['name']);
            $user->setRole($u[0]['role_id']);
            $user->setDevise($u[0]['devise_id']);
            $_SESSION['user'] = serialize($user);

           //s'il a coché la case 'se souvenir'
            if($remember){
                cookie($this->login, $this->password, $remember);
            }

            $isConnected = true;
       }
       return $isConnected;
    }
    
    public function deleteUserById($bdd, $id) {
        $req = $bdd->prepare("DELETE FROM user WHERE id = :id");
        return $req->execute(array(
            ":id"   =>  $id
        ));
        
    }
    
    public function getUserById($bdd,$id)
    {
        $CloneUser = new User();
        $getUserInfo = $bdd->prepare("SELECT * FROM user WHERE id = :id LIMIT 1");
        $getUserInfo->execute(array(':id' => $id));   
        
        $array = $getUserInfo->fetch();

        $CloneUser->setDevise($array['devise_id']);
        $CloneUser->setEmail($array['mail']);
        $CloneUser->setId($array['id']);
        $CloneUser->setLogin($array['login']);
        $CloneUser->setName($array['name']);
        $CloneUser->setPassword($array['password']);
        $CloneUser->setRole($array['role_id']);
        
        return $CloneUser;
    }
    public function editUser($bdd)
    {
        $req = $bdd->prepare("UPDATE user SET password = :password, devise_id = :devise_id, mail = :mail WHERE id = :id");
        $req->execute(array(
        ':password' => $this->password,
        ':devise_id' => $this->devise,
        'mail' => $this->mail,
        ':id' => $this->id
        ));
    }
    
    public function editUserByAdmin($bdd, $CloneUser)
    {
        $req = $bdd->prepare("UPDATE user SET name = :name, login = :login, password = :password, mail = :mail, role_id = :role_id, devise_id = :devise_id WHERE id = :id");
        $req->execute(array(
            ':name' => $CloneUser->getname(),
            ':login' => $CloneUser->getLogin(),
            ':password' => $CloneUser->getPassword(),
            ':mail' => $CloneUser->getEmail(),
            'role_id' => $CloneUser->getRole(),
            ':devise_id' => $CloneUser->getDevise(),
            ':id' => $this->id
        ));  
        
    }
    
    function __destruct()
    {

    }
}
