<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
// Testons si le fichier a bien été envoyé et s'il n'y a pas d'erreur
if (isset($_POST['valider']))
{
    if(verifValue())
    {
        $req = $bdd->prepare("INSERT INTO frais(image, date, description, montant, devise_id, note_id, categorie_id) VALUES(:image, :date, :description, :montant, :devise_id, :note_id, :categorie_id)");

        $req->bindParam('image', $nameImage); 
        $req->bindParam('date', $date);
        $req->bindParam('description', $description);
        $req->bindParam('montant', $montant);
        $req->bindParam('devise_id', $devise_id);
        $req->bindParam('note_id', $note_id);
        $req->bindParam('categorie_id', $categorie_id);



     // Testons si le fichier n'est pas trop gros ici 1Mo maximum
        if ($_FILES['image']['size'] <= 1000000)
        {
            //On prend la date pour l'ajouter dans le nom de l'image upload 
            $dateImage = date("d-m-Y");
            $heureImage = date("H-i-s");
            //On récupère le nom de l'user pour l'ajouter au nom de l'image upload
            $user = unserialize($_SESSION['user']);
            $userName = $user->getLogin();

            // Testons si l'extension est autorisée
            $infosfichier = pathinfo($_FILES['image']['name']);
            $extension_upload = $infosfichier['extension'];
            $extensions_autorisees = array('jpg', 'jpeg', 'png');

            //Construction du nom de fichier
            $nom = $userName . $dateImage .'-'. $heureImage . '.' . $extension_upload;
            if (in_array($extension_upload, $extensions_autorisees))
            {
                // Methode qui deplce le fichier et change son nom
                $test = move_uploaded_file($_FILES['image']['tmp_name'], 'image/uploads/'. $nom);
                if($test == TRUE)
                {           
                    $nameImage = $nom;
                    $date = filter_input(INPUT_POST, 'date');
                    $description = nl2br(filter_input(INPUT_POST, 'description'));
                    $montant = filter_input(INPUT_POST, 'montant');
                    $devise_id = filter_input(INPUT_POST, 'devise_id');
                    $note_id = filter_input(INPUT_POST, 'note_id');
                    $categorie_id = filter_input(INPUT_POST, 'categorie_id');
                    $req->execute();

                    echo '<div class="bg-success">Le frais à bien été ajouté </div><br/><br/>';
                    include_once "/views/include/frais.php";
                }else{
                    echo "Une erreur est survenue !";
                    include_once "/views/include/frais.php";
                }          
            }
            $req->closeCursor();
        }
    }
    else
    {
        include_once "/views/include/frais.php";
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
    $resultatRetour = true;
    //Verifie qu'un fichier est bien présent
    if (!isset($_FILES['image']) || !$_FILES['image']['error'] == 0)
    {
        echo 'Erreur avec le justificatif (image)';
        $resultatRetour = false;
    }
    //Verifie le format de la date et si le champ à été remplit
    else if(!strtotime(nl2br(filter_input(INPUT_POST, 'date'))))
    {
        echo 'Erreur lors de la saisie de la Date  ';
        $resultatRetour = false;
    }
    //Verifie que la description ne dépasse pas 255 caractères
    else if (strlen(filter_input(INPUT_POST, 'description'))> 255)
    {
        echo 'Description trop longue (255 caractères maximum !).';
        $resultatRetour = false;
    }
    //Verifie que nous avons un montant correct (pas de lettres)
    else if (!is_numeric(filter_input(INPUT_POST, 'montant')))
    {
        echo 'Montant incorrect, merci de mettre des . pour les centimes ex : 22.90';
        $resultatRetour = false;
    }
    return $resultatRetour;
}