<?php

if (isset($_POST['deleteUser']) && !empty($_POST['deleteUser'])) {
    //User::deleteUserById($bdd, $_POST['delete']);
    //$data = true;
    header('Content-Type: application/json');
    $data = ["updated"=>true];
    echo json_encode($data);
}
