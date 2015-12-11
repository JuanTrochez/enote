<?php
    include_once 'function/bdd.php';
    include_once "/class/Security.php";
    include_once '/class/User.php';

    $basePath = "http://" . $_SERVER["SERVER_NAME"] . "/enote/";
    $secu = new Security();

    // si il y a un cookie, on connect l'user.
    if (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
    isset($_COOKIE['password']) && !empty($_COOKIE['password']))
    {
        $user = new User();
        $user->setLogin($_COOKIE['login']);
        $user->setPassword($_COOKIE['password']);
        $user->connect($bdd,true);
        echo "cookie set session";
    }
    
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $sessionUser = unserialize($_SESSION['user']);
    }

    // si une page est demandée avec '?p=pageDemandee' (dans l'url)
    if(isset($_GET['page']) && !empty($_GET['page']) && preg_match("/^[a-zA-Z0-9-]+$/i",$_GET['page'])){
        if (!$secu->logged() && $_GET['page'] != 'connexion'){ 
            header("Location: " . $basePath . "?page=connexion");  
        }
        
        $p = htmlspecialchars(htmlentities($_GET['page']));
        // Vérifie si le fichier existe avant inclusion
        if(file_exists('controller/' . $p . 'Controller.php')){
                include_once 'views/global/header.php'; // Inclusion de l'entete de la page

                include_once 'controller/' . $p . 'Controller.php'; // Inclusion du contenu de la page

                // Inclusion du pied de page
                include_once 'views/global/footer.php';

        }else{// sinon renvoi une erreur 404 si le fichier n'existe pas
                include_once 'views/global/header.php'; // Inclusion de l'entete de la page

                include_once 'views/include/404.php'; // Inclusion du contenu de la page

                // Inclusion du pied de page
                include_once 'views/global/footer.php';
        }

    } elseif (isset($_GET['request']) && !empty($_GET['request'])) {
        if (!$secu->logged()) {
            header("Location: " . $basePath . "?page=connexion"); 
        }
        include_once 'controller/jsonController.php';
    } else {
        if (!$secu->logged()) {
            header("Location: " . $basePath . "?page=connexion"); 
        }
        include_once 'views/global/header.php'; // Inclusion de l'entete de la page

        include_once 'controller/accueilController.php';
        
        // Inclusion du pied de page
        include_once 'views/global/footer.php';
    }

?>
