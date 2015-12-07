<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (verifValue())
{
    //$req = $bdd->prepare('INSERT INTO frais(image, date, description, montant, devise_id, note_id, categorie_id) VALUES(:image, :date, :description, :montant, :devise_id, :note_id, :categorie_id)');
    $date = filter_input(INPUT_POST, 'date');
    $description = filter_input(INPUT_POST, 'description');
    $montant = filter_input(INPUT_POST, 'montant');
    $devise_id = filter_input(INPUT_POST, 'devise_id');
    
 // Testons si le fichier n'est pas trop gros ici 1Mo maximum
    if ($_FILES['monfichier']['size'] <= 1000000)
    {
        //On prend la date pour l'ajouter dans le nom de l'image upload 
        $dateImage = date("d-m-Y");
        $heureImage = date("H-i-s");
        //On récupère le nom de l'user pour l'ajouter au nom de l'image upload
        $user = unserialize($_SESSION['user']);
        $userName = $user->getLogin();
        
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['monfichier']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');
        
        //Construction du nom de fichier
        $nom = $userName . $dateImage .'-'. $heureImage . '.' . $extension_upload;
        
        if (in_array($extension_upload, $extensions_autorisees))
        {
            // Methode qui deplce le fichier et change son nom
            $test = move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/'. $nom);
            if($test == TRUE)
            {
                echo "L'envoi a bien été effectué !";
                echo $date;
            }else{
                echo "Une erreur est survenue !";
            }          
        }
        
//        $req->execute(array(
//	'image' => $nom,
//	'date' => $date,
//	'description' => $description,
//	'montant' => $montant,
//	'devise_id' => $devise_id,
//	'categorie_id' => $categorie_id
//	));
        //$req->closeCursor();
    }
}else{
    if (isset($_SESSION['user']) && !empty($_SESSION['user']))
    {
        include_once "/views/include/frais.php";
    }
    else 
    {
        header("Location: ?page=connexion");
    }
}

function verifValue()
{
    $date = filter_input(INPUT_POST, 'date');
    //Verifie qu'un fichier est bien présent
    if (!isset($_FILES['monfichier']) OR !$_FILES['monfichier']['error'] == 0)
    {
        return false;
    }
    //Verifie le format de la date et si le champ à été remplit
    else if(!isset($date) OR !VerifierDateValide($date))
    {
        echo 'Erreur lors de la saisie de la Date';
        return false;
    }
    //Verifie que la description ne dépasse pas 255 caractères
    else if (strlen(filter_input(INPUT_POST, 'description'))> 255)
    {
        echo 'Description trop longue (255 caractères maximum !).';
        return false;
    }
    //Verifie que nous avons un montant correct (pas de lettres)
    else if (!is_numeric(filter_input(INPUT_POST, 'montant')))
    {
        echo 'Montant incorrect, merci de mettre des . pour les centimes ex : 22.90';
        return false;
    }
    return true;
}

// La fonction vérifie que la date à le bon format et des dates cohérentes
function VerifierDateValide($Date){
    if (preg_match('#^([0-9]{2})([/-])([0-9]{2})\2([0-9]{4})$#', $Date, $m) == 1 && checkdate($m[3], $m[1], $m[4]))
    {
      return true;
    }
    else
    {
      return false;
    }
}