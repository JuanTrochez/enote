<?php
	//include_once 'global/bdd.php';
	
	//$security = new Security();

//	function cookie($pseudo, $password, $undo='non'){
//		if($undo == 'non'){
//			setcookie('pseudo', ''.$pseudo.'', time() + 365*24*3600, null, null, false, true); 
//			setcookie('password', ''.$password.'', time() + 365*24*3600, null, null, false, true);
//		}else{
//			setcookie('pseudo', '', time() -3600, null, null, false, true); 
//			setcookie('password', '', time() -3600, null, null, false, true);
//		}
//	}
//	if(isset($_COOKIE['pseudo']) && !empty($_COOKIE['pseudo']) 
//		&& isset($_COOKIE['password']) && !empty($_COOKIE['password']) 
//		&& !isset($_SESSION['user'])){//pour connecter automatiquement 
//		$resultat = $bdd->prepare("SELECT * 
//											FROM users 
//											WHERE pseudo = :pseudo
//											AND password = :password
//											LIMIT 1");
//
//		$resultat->execute(array(
//			":pseudo"		=> $_COOKIE['pseudo'],
//			":password"		=> $_COOKIE['password']
//			));
//		//verifie que la requete renvoi une valeur
//		if($resultat->rowCount() != 0){
//			$user = $resultat->fetchAll();
//			$_SESSION['user'] = $user[0];
//		}else{
//			cookie($pseudo, $password, $undo='oui');
//		}
//	}

        // si une page est demandée avec '?p=pageDemandee' (dans l'url)
	if(isset($_GET['page']) && !empty($_GET['page']) && preg_match("/^[a-zA-Z0-9-]+$/i",$_GET['page'])){
		$p = htmlspecialchars(htmlentities($_GET['page']));
		// Vérifie si le fichier existe avant inclusion
		if(file_exists('views/include/' . $p . '.php')){
			include_once 'views/global/header.php'; // Inclusion de l'entete de la page

			include_once 'controller/' . $p . '.php'; // Inclusion du contenu de la page

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
		
		include_once 'controller/accueil.php';

		// Inclusion du pied de page
		include_once 'views/global/footer.php';
	}

?>
