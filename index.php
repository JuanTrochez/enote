<?php
    include_once 'function/bdd.php';
    include_once "/class/Security.php";
    include_once '/class/User.php';

    $basePath = "http://" . $_SERVER["SERVER_NAME"] . "/enote/";
    $secu = new Security();
    
    $redirect_connection = "Location: " . $basePath . "?page=connexion";
    $view_header = 'views/global/header.php';
    $view_footer = 'views/global/footer.php';
    // si il y a un cookie, on connect l'user.
    if (isset($_COOKIE['login']) && !empty($_COOKIE['login']) &&
    isset($_COOKIE['password']) && !empty($_COOKIE['password']))
    {
        $user = new User();
        $user->setLogin(filter_input(INPUT_COOKIE, 'login'));
        $user->setPassword(filter_input(INPUT_COOKIE, 'password'));
        $user->connect($bdd,true);
        echo "cookie set session";
    }
    
    if (isset($_SESSION['user']) && !empty($_SESSION['user'])) {
        $sessionUser = unserialize($_SESSION['user']);
    }

    // si une page est demandée avec '?p=pageDemandee' (dans l'url)
    if(isset($_GET['page']) && !empty($_GET['page']) && preg_match("/^[a-zA-Z0-9-]+$/i",$_GET['page'])){
        if (!$secu->logged() && $_GET['page'] != 'connexion'){ 
            header($redirect_connection);  
        }
        
        $p = htmlspecialchars(htmlentities($_GET['page']));
        // Vérifie si le fichier existe avant inclusion
        if(file_exists('controller/' . $p . 'Controller.php'))
        {
            // Inclusion de l'entete de la page
            include_once $view_header;
            // Inclusion du contenu de la page
            include_once 'controller/' . $p . 'Controller.php';
            // Inclusion du pied de page
            include_once $view_footer;
        }
        // sinon renvoi une erreur 404 si le fichier n'existe pas
        else
        {   
            // Inclusion de l'entete de la page
            include_once $view_header;
            // Inclusion du contenu de la page
            include_once 'views/include/404.php';
            // Inclusion du pied de page
            include_once $view_footer;
        }

    } elseif (isset($_GET['request']) && !empty($_GET['request'])) {
        if (!$secu->logged()) {
            header($redirect_connection); 
        }
        include_once 'controller/jsonController.php';
    } else {
        if (!$secu->logged()) {
            header($redirect_connection); 
        }
        // Inclusion de l'entete de la page
        include_once $view_header;

        include_once 'controller/accueilController.php';
        
        // Inclusion du pied de page
        include_once $view_footer;
    }
?>