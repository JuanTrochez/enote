<?php
include_once "/class/User.php";
include_once "/views/include/connexion.php";



if (isset($_POST['pwd']) && isset($_POST['login'])) {    
    $user = new User();
    $user->setLogin($_POST['login']);
    $user->setPassword($_POST['pwd']);
    
    if ($user->connect($bdd)) {
        echo "vous etes connecté";
    } else {
        echo "erreur dans le login/password";
    }
}
