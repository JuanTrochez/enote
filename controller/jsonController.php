<?php
include_once '/class/Note.php';

if (isset($_POST) && !empty($_POST)) {
//    var_dump($_POST);    
    header('Content-Type: application/json');
    
    $data = [];
    
    foreach ($_POST as $key => $value) {
        
        switch ($key) {
            case 'deleteUser':
                $result = User::deleteUserById($bdd, $value);
                $data = ["updated"=> $result];

                break;

            case 'deleteNote':
                $result = Note::deleteNoteById($bdd, $value);
                $data = ["updated"=> $result];

                break;

            case 'deleteFrais':
                $result = User::deleteFraisById($bdd, $value);
                $data = ["updated"=> $result];

                break;

            default:
                break;
        }
        
    }
        
    echo json_encode($data);
}
