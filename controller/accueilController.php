<?php
include_once "/class/Note.php";
include_once "/class/Statut.php";
include_once "/class/User.php";

if (isset($_SESSION['user']) && !empty($_SESSION['user']))
{
        $user = unserialize($_SESSION['user']);
	$notes = $user->getNotes($bdd);
        $fraisNote = new Note();
        $statut = new Statut();
        $listStatut = $statut->getAll($bdd);
        $noteStatut = new Statut();

    include_once "/views/include/accueil.php";
}

else
{
    header("Location: http://localhost/enote/?page=connexion");
}

