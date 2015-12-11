<?php

include_once '/class/User.php';
include_once '/class/Note.php';


if (!$secu->isAdmin($bdd)) {
    header("Location: " . $basePath);
}

if (isset($_GET['action']) && !empty($_GET['action'])) {
    
    switch ($_GET['action']) {
        //gestion des utilisateurs
        case "user":
            $listUser = User::getAllUser($bdd);     
            
            include_once '/views/admin/user.php';
        break;

        //Statistiques
        case "statistique":

            include_once '/views/admin/statistique.php';
        break;

        //Gestion des notes
        case "note":

            include_once '/views/admin/note.php';
        break;

        //par defaut on a les statistiques
        default:
            include_once '/views/admin/statistique.php';
            break;
    }
    
} else {
    include_once '/views/admin/index.php';
}

