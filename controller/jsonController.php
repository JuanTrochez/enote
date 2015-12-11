<?php

if (isset($_POST['deleteUser']) && !empty($_POST['deleteUser'])) {
    header('Content-Type: application/json');
    $result = User::deleteUserById($bdd, $_POST['deleteUser']);
    $data = ["updated"=> $result];
    echo json_encode($data);
}
