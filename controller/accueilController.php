<?php
if ($_SESSION['user'])
{
    include_once "/views/include/accueil.php";
}
else 
{
    include_once "/views/include/connexion.php";
}
