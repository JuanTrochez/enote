<?php
class Security {

    function __construct() {

    }
    
    function __destruct() {

    }

    public static function logged(){
        if (isset($_SESSION['user']))
            { return true; }
        return false;
    }

    public function isAdmin($bdd) {
    if (Security::logged())
    {
        $user = unserialize($_SESSION['user']);
        $result = $bdd->prepare("SELECT * FROM user "
                . "WHERE id = :id AND role_id = 1 LIMIT 1");

        $result->execute(array(
                ":id" => $user->getId()
                ));

        return ($result->rowCount() == 1);
    }
    return false;
    }
    
    public function isManager($bdd) {
    if (Security::logged())
    {
        $user = unserialize($_SESSION['user']);
        $result = $bdd->prepare("SELECT * FROM user "
                . "WHERE id = :id AND role_id = 2 LIMIT 1");

        $result->execute(array(
                ":id" => $user->getId()
                ));

        return ($result->rowCount() == 1);
    }
    return false;
    }

}
