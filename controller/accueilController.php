<?php
include_once "/class/Devise.php";
include_once "/class/Note.php";
include_once "/class/Statut.php";
include_once "/class/User.php";

$notes = $sessionUser->getNotes($bdd);
$fraisNote = new Note();
$statut = new Statut();
$listStatut = $statut->getAll($bdd);
$noteStatut = new Statut();

include_once "/views/include/accueil.php";


