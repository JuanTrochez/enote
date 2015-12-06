<?php
class Security {

    function __construct() {

    }
    function __destruct() {

    }

    public function logged(){
        if (isset($_SESSION['user'])) {
            return true;

        } else {
            return false;
        }
    }

    public function isAdmin() {
        if (logged()) {
            $user = unserialize($_SESSION['user']);
            $result = $bdd->prepare("SELECT * FROM user "
                    . "WHERE id = :id AND role_id = 1 "
                    . "LIMIT 1");

            $result->execute(array(
                    ":id"		=>	$user->getId()
                    ));

            if($result->rowCount() == 1){
                    return true;

            }else{
                    return false;
            }

        } else {
            return false;
        }
    }

}
