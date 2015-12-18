<?php

include_once '/class/User.php';
include_once '/class/Note.php';
include_once '/class/Devise.php';
include_once '/class/Statut.php';
include_once '/class/Frais.php';
include_once '/class/CategorieFrais.php';
include_once '/class/Role.php';


if (!$secu->isAdmin($bdd) && !$secu->isManager($bdd)) {
    header("Location: " . $basePath);
}

if (isset($_GET['section']) && !empty($_GET['section'])) {
    
    switch (filter_input(INPUT_GET, 'section')) {
        //gestion des utilisateurs
        case "user":
            if (isset($_GET['action']) && (strcmp($_GET['action'], 'adduser') == 0)){
                if (isset($_POST['Ajouter']) && verifAjout())
                {
                    $nameuser = htmlentities($_POST['name_user']);
                    $newuser = new User();
                    $newuser->setName($nameuser);
                    $newuser->setLogin($_POST['log']);
                    $newuser->setPassword(sha1($_POST['pwd']));
                    $newuser->setEmail($_POST['email']);
                    $newuser->setRole($_POST['role']);
                    $newuser->setDevise($_POST['devise']);

                    $newuser->insertNewUser($bdd);
                    echo '<div class="bg-success">L\'utilisateur à bien été ajoutée</div><br/><br/>';
                }
                include_once '/views/admin/adduser.php';
                break;
            }
            
            //on retourne la liste d'utilisateur en fonction du role
            if ($secu->isAdmin($bdd)) {
                $listUser = User::getAllUser($bdd);
            } else {
                $listUser = User::getUsersByManagerId($bdd, $sessionUser->getId());
            }
            
            include_once '/views/admin/user.php';
        break;

        //Statistiques
        case "statistique":

            include_once '/views/admin/statistique.php';
        break;

        //Gestion des notes
        case "note":
            //on retourne la liste des notes en fonction du role de l'utilisateur
            if ($secu->isAdmin($bdd)) {
                $notes = Note::getAllNotes($bdd);
            } else {
                $listUser = User::getUsersByManagerId($bdd, $sessionUser->getId());
                $notes = [];
                foreach ($listUser as $user) {
                    $listNote = Note::getNotesByUser($bdd, $user["id"]);
                    $notes = array_merge($notes, $listNote);
                }
            }
            $fraisNote = new Note();
            $statut = new Statut();
            $listStatut = $statut->getAll($bdd);
            $noteStatut = new Statut();
            include_once '/views/admin/note.php';
        break;
        //par defaut on a les statistiques
        default:
            include_once '/views/admin/index.php';
            break;
    }
    
} else {
    include_once '/views/admin/index.php';
}

function verifAjout()
{
    $ajoutCorrect = true;  
    // Verifie que les champs sont remplies
    if(!isset($_POST['name_user'],$_POST['log'],$_POST['pwd'],$_POST['pwd2'],$_POST['email']))
    {
        echo 'Erreur veuillez remplir tous les champs';
        $ajoutCorrect = false;
    }
    //Verifie que le nouveau mot de passe est supérieur ou égale à 6 caractères
    else if(strlen($_POST['pwd'])<6)
    {
        echo 'Veuillez choisir un mot de passe de 6 caratères minimum';
        $ajoutCorrect = false;
    }
    //Verifie que la confirmation du mot de passe est correct
    else if(strcmp($_POST['pwd'], $_POST['pwd2']) != 0)
    {
        echo 'Erreur avec la confirmation du mot de passe';
        $ajoutCorrect = false;
    }
    return $ajoutCorrect;
}