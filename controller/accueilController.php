<?php

include_once "/class/User.php";

if (isset($_SESSION['user']) && !empty($_SESSION['user']))
{
    echo "hello accueil";
    include_once "/views/include/accueil.php";
}

else 
{
    header("Location: ?page=connexion");
}

