<?php

if (isset($_SESSION['user']) && !empty($_SESSION['user']))
{
    include_once "/views/include/accueil.php";
}

else 
{
    header("Location: http://localhost/enote/?page=connexion");
}

