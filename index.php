<?php
	include_once 'function/bdd.php';
        
        $basePath = "http://" . $_SERVER["SERVER_NAME"] . "/enote/";

        // si une page est demandée avec '?p=pageDemandee' (dans l'url)
	if(isset($_GET['page']) && !empty($_GET['page']) && preg_match("/^[a-zA-Z0-9-]+$/i",$_GET['page'])){
		$p = htmlspecialchars(htmlentities($_GET['page']));
		// Vérifie si le fichier existe avant inclusion
		if(file_exists('views/include/' . $p . '.php')){
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
	
	}else{
		include_once 'views/global/header.php'; // Inclusion de l'entete de la page
		
		include_once 'controller/accueilController.php';

		// Inclusion du pied de page
		include_once 'views/global/footer.php';
	}

?>
