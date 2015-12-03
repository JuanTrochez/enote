<?php
include_once "/class/User.php";
include_once "/views/include/connexion.php";

if(isset($_POST['login']) && isset($_POST['pwd'])){
    if(!empty($_POST['login']) && !empty($_POST['pwd'])){

        //initialisations des variables
        $login = htmlentities($_POST['login']);
        $password = htmlentities($_POST['pwd']);
        $remember = false;

        $user = new User();
        $user->setLogin($login);
        $user->setPassword($password);
        
        //s'il a coché la case 'remember' on set la variable a true
        if(isset($_POST['souvenir']) && !empty($_POST['souvenir'])){
            $remember = true;
        }
        
        if ($user->connect($bdd, $remember)) {
            header('Location: ?page=accueil.php');
        } else {
            echo "<div class='erreur'>Erreur dans le pseudo/mot de passe</div>";
        }
        

    } else { echo "<div class='erreur'>Des champs n'ont pas été remplis !</div>"; }
}else{ echo "<div class='erreur'>Des champs n'ont pas été remplis !</div>"; }


