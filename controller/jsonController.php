<?php
include_once '/class/Note.php';
include_once '/class/Frais.php';

if (isset($_POST) && !empty($_POST)) {
    header('Content-Type: application/json');
    
    $data = [];
    
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
        
    echo json_encode($data);
}
