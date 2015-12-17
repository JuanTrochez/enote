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
                //couts par categorie
                $allCategorie = CategorieFrais::getAllCategorie($bdd);
                $userDevise = Devise::getDeviseById($bdd, $sessionUser->getDevise())->getTaux();
                
                //couts pour les 10 premiers utilisateurs
                $userCouts = Note::getCoutOfUser($bdd);
                
                //incrementation pour lesfrais par mois de l'année
                $i = 1;
                
                //couleur des categories
                $color = 30;

                foreach ($allCategorie as $categorie) {
                    $categorieCout = Frais::getCoutByCategorieId($bdd, $categorie["id"]);
                    $fdevise = Devise::getDeviseById($bdd, $categorieCout['devise_id'])->getTaux();
                    $data["categorie"]["labels"][] = $categorie["name"];                    
                    $data["categorie"]["cout"][] = Devise::getValueOfChangedDevise($categorieCout["totalCat"], $fdevise, $userDevise);
                    $data["categorie"]["all"][] = [
                        "value"     => Devise::getValueOfChangedDevise($categorieCout["totalCat"], $fdevise, $userDevise),
                        "color"     =>  "rgb(" . $color . ", " . $color * 2 . ", " . $color / 2 . ")",
                        "highlight" =>  "rgb(" . ($color + 15) . ", " . (($color * 2) + 15) . ", " . ($color + 15) . ")",
                        "label"     =>  $categorie["name"]
                    ];
                    
                    $color += 30;
                }
                                
                while ($i <= 12) {
                    $coutMois = Frais::getCoutParMois($bdd, $i);
                    $fdevise = Devise::getDeviseById($bdd, $coutMois['devise_id'])->getTaux();
                    
                    if ($coutMois == NULL) {
                        $coutMois = 0;
                    }
                    $data["mois"]["cout"][] = Devise::getValueOfChangedDevise($coutMois["totalMois"], $fdevise, $userDevise);
                    $i++;
                }
                
                foreach ($userCouts as $uCout) {
                    $data["user"]["login"][] = $uCout["username"];
                    $data["user"]["cout"][] = $uCout["total"];
                }

                break;

            default:
                break;
        }
        
    }
}

    // on retourne la reponse json
    echo json_encode($data);
    
    
function dynamicColor($index){
};
    