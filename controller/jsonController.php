<?php
include_once '/class/Note.php';
include_once '/class/Frais.php';
include_once '/class/CategorieFrais.php';
include_once '/class/Devise.php';


header('Content-Type: application/json');
$data = [];

if (isset($_POST) && !empty($_POST)) {
    
    foreach ($_POST as $key => $value) {
        
        switch ($key) {
            case 'deleteUser':
                if (!$secu->isAdmin($bdd)) {
                    $data = ["updated"=> false];
                    break;
                }
                $result = User::deleteUserById($bdd, $value);
                $data = ["updated"=> $result];

                break;

            case 'deleteNote':
                $result = Note::deleteNoteById($bdd, $value);
                $data = ["updated"=> $result];

                break;

            case 'deleteFrais':
                if (!$secu->isAdmin($bdd)) {
                    $data = ["updated"=> false];
                    break;
                }
                $result = Frais::deleteFraisById($bdd, $value);
                $data = ["updated"=> $result];

                break;

            default:
                break;
        }
        
    }
    
} else if (isset($_GET) && !empty($_GET)) {
    foreach ($_GET as $key => $value) {
        
        switch ($key) {
            case 'statistique':
                $allCategorie = CategorieFrais::getAllCategorie($bdd);
                $userDevise = Devise::getDeviseById($bdd, $sessionUser->getDevise())->getTaux();
                //incrementation pour les mois de l'année
                $i = 1;

                foreach ($allCategorie as $categorie) {
                    $categorieCout = Frais::getCoutByCategorieId($bdd, $categorie["id"]);
                    $fdevise = Devise::getDeviseById($bdd, $categorieCout['devise_id'])->getTaux();
                    $data["categorie"]["labels"][] = $categorie["name"];
                    $data["categorie"]["cout"][] = Devise::getValueOfChangedDevise($categorieCout["totalCat"], $fdevise, $userDevise);
                }
                                
                while ($i <= 12) {
                    $coutMois = Frais::getCoutParMois($bdd, $i);                    
                    $fdevise = Devise::getDeviseById($bdd, $coutMois['devise_id'])->getTaux();
                    
                    if ($coutMois == NULL) {
                        $coutMois = 0;
                    }
                    $data["mois"]["cout"][$i] = Devise::getValueOfChangedDevise($coutMois["totalMois"], $fdevise, $userDevise);
                    $i++;
                }

                break;

            default:
                break;
        }
        
    }
}

    // on retourne la reponse json
    echo json_encode($data);
    