<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_FILES['monfichier']) AND $_FILES['monfichier']['error'] == 0)
{
 // Testons si le fichier n'est pas trop gros
    if ($_FILES['monfichier']['size'] <= 1000000)
    {
        //On prend la date pour l'ajouter dans le nom de l'image upload 
        $date = date("d-m-Y");
        $heure = date("H-i-s");
        //On récupère le nom de l'user pour l'ajouter au nom de l'image upload
        $user = unserialize($_SESSION['user']);
        $userName = $user->getLogin();
        
        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($_FILES['monfichier']['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');
        
        //Construction du nom de fichier
        $nom = $userName . $date .'-'. $heure . '.' . $extension_upload;
        
        if (in_array($extension_upload, $extensions_autorisees))
        {
            // Methode qui deplce le fichier et change son nom
            $test = move_uploaded_file($_FILES['monfichier']['tmp_name'], 'uploads/'. $nom);
            if($test == TRUE)
            {
                echo "L'envoi a bien été effectué !";
            }else{
                echo "Une erreur est survenue !";
            }          
        }
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