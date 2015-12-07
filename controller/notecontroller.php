<?php
include_once "/class/Statut.php";
include_once "/class/User.php";

if (isset($_SESSION['user']) && !empty($_SESSION['user']))
{
        $user = unserialize($_SESSION['user']);

    include_once "/views/include/note.php";
}

else
{
    header("Location: http://localhost/enote/?page=connexion");
}