<?php

include_once "/class/Frais.php";

// Testons si le fichier a bien été envoyé, s'il n'y a pas d'erreur et si il n'est pas trop gros ici 1Mo maximum
if (isset($_POST['valider']))
{
    $image = $_FILES['image'];
    $montant = filter_input(INPUT_POST, 'montant');
    $idnote = filter_input(INPUT_POST, 'note_id');
    if (verifValue($bdd,$image,$montant,$idnote) && ($image['size'] <= 1000000))
    {
        //On prend la date pour l'ajouter dans le nom de l'image upload 
        $dateImage = date("d-m-Y");
        $heureImage = date("H-i-s");
        //On récupère le nom de l'user pour l'ajouter au nom de l'image upload
        $userName = $sessionUser->getLogin();

        // Testons si l'extension est autorisée
        $infosfichier = pathinfo($image['name']);
        $extension_upload = $infosfichier['extension'];
        $extensions_autorisees = array('jpg', 'jpeg', 'png');

        //Construction du nom de fichier
        $nom = $userName . $dateImage .'-'. $heureImage . '.' . $extension_upload;
        // Methode qui deplce le fichier et change son nom
        $test = move_uploaded_file($image['tmp_name'], 'image/'. $nom);
        if (in_array($extension_upload, $extensions_autorisees) && $test)
        {       
            $frais = new Frais();
            $frais->setCategorie(filter_input(INPUT_POST, 'categorie_id'));
            $frais->setDate(filter_input(INPUT_POST, 'date'));
            $frais->setDescription(nl2br(filter_input(INPUT_POST, 'description')));
            $frais->setDevise(filter_input(INPUT_POST, 'devise_id'));
            $frais->setImage($nom);
            $frais->setMontant($montant);
            $frais->setNote($idnote);

            if(isset($_GET['id']) && !empty($_GET['id'])){
                $frais->setId($_GET['id']);
                $frais->upDateFrais($bdd);
            }
            else{ $frais->insertFrais($bdd); }                   

            echo '<div class="bg-success">Le frais à bien été ajouté </div><br/><br/>';
        }
        else{ echo "Une erreur est survenue !"; }          
    }
}
if(isset($_GET['id']) && !empty($_GET['id'])){
    $fraisEdit = Frais::getFraisById($bdd,$_GET['id']);
    include_once "/views/include/fraisEdit.php";
}else{
    include_once "/views/include/frais.php";
}

function verifValue($bdd,$image,$montant,$idnote)
{
    $resultatRetour = false;
    //Verifie qu'un fichier est bien présent
    if (!isset($image) || !($image['error']) == 0)
    {
        echo 'Erreur avec le justificatif (image)';
    }
    //Verifie le format de la date et si le champ à été remplit
    else if(!strtotime(nl2br(filter_input(INPUT_POST, 'date'))))
    {
        echo 'Erreur lors de la saisie de la Date  ';
    }
    //Verifie que la description ne dépasse pas 255 caractères
    else if (strlen(filter_input(INPUT_POST, 'description'))> 255)
    {
        echo 'Description trop longue (255 caractères maximum !).';
    }
    //Verifie que nous avons un montant correct (pas de lettres)
    else if (!is_numeric($montant) || $montant>50000 || $montant<0)
    {
        echo 'Montant incorrect, merci de mettre des . pour les centimes ex : 22.90';
    }
    else if (is_numeric($idnote)){
        $check = $bdd->prepare('SELECT * FROM note_frais WHERE statut_id = 1 AND id=:id limit 1');
        $check->execute(array(
        ":id"=>$idnote
        ));
        if ($check->rowCount()!=1) {
            echo 'Stop F12 !';
        }
        else { $resultatRetour = true; }
    }
    else { $resultatRetour = true; }
    return $resultatRetour;
}