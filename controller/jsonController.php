<?php

if (isset($_POST['deleteUser']) && !empty($_POST['deleteUser'])) {
    $result = User::deleteUserById($bdd, $_POST['delete']);
    header('Content-Type: application/json');
    $data = ["result" => $result];
    echo json_encode($data);
}
