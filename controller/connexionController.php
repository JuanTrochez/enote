<?php
include_once "/class/User.php";
include_once "/views/include/connexion.php";

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $pwd = $_POST['pwd'];
    if(isset($login, $pwd)){
        if(!empty($login) && !empty($pwd)){

            //initialisations des variables
            $login = htmlentities($login);
            $password = sha1(htmlentities($pwd));
            $remember = false;

            $user = new User();
            $user->setLogin($login);
            $user->setPassword($password);

            //s'il a coché la case 'remember' on set la variable a true
            if(isset($_POST['remember']) && !empty($_POST['remember'])){
                $remember = true;
            }

            if ($user->connect($bdd, $remember)) {
                header('Location: ' . $basePath);
            } else {
                echo "<div class='erreur'>Erreur dans le pseudo/mot de passe</div>";
            }


        } else { echo "<div class='erreur'>Des champs n'ont pas été remplis !</div>"; }
    }else{ echo "<div class='erreur'>Des champs n'ont pas été remplis !</div>"; }
}

