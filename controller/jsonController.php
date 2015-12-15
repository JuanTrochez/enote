<?php
include_once '/class/Note.php';
include_once '/class/Frais.php';
include_once '/class/CategorieFrais.php';


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
        
        switch ($value) {
            case 'categorie':
                $allCategorie = CategorieFrais::getAllCategorie($bdd);

                foreach ($allCategorie as $categorie) {
                    $data["labels"][] = utf8_encode($categorie["name"]);
                }
                

                break;

            default:
                break;
        }
        
    }
}

    // on retourne la reponse json
    echo json_encode($data);
    