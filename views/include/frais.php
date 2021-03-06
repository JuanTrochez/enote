<?php
include_once '/class/Devise.php';
include_once '/class/CategorieFrais.php';

$montan = 'montant';
$descriptio = 'description';
$noteid = 'note_id';
$categori = 'categorie_id';
?>

<h2>Ajout d'un nouveau frais</h2><br />
<form  class = "form" action="" method="POST" enctype="multipart/form-data">
    <p>
        <input class = "formulaire form-control champ-form" type="file" name="image" />
        <input class = "formulaire form-control champ-form formulaireReduit" type="date" max="<?php echo date('Y-m-d');?>" name="date" placeholder="aaaa/mm/jj" value="<?php if(isset($_POST['date']) && !empty($_POST['date'])){echo filter_input(INPUT_POST, 'date'); } ?>"/>
        <textarea class = "formulaire form-control champ-form descriptionFormulaire" name="description" placeholder="Description"><?php if(isset($_POST[$descriptio]) && !empty($_POST[$descriptio])){echo filter_input(INPUT_POST, $descriptio); } ?></textarea>
        <div id ="blocPrix">
            <input class = "formulaire  formulairePrixTTC form-control champ-form" type="text" name="montant" placeholder="HT" value="<?php if(isset($_POST[$montan]) && !empty($_POST[$montan])){echo filter_input(INPUT_POST, $montan); } ?>"/>
              
            <select class = "formulaire formulairePrix form-control champ-form" name="devise_id">
            <?php
                $reponseDevise = Devise::getAllDevise($bdd);
                while($donnee = $reponseDevise->fetch())
                    { ?>
                        <option value="<?php echo $donnee['id'];?>" <?php if($sessionUser->getDevise() == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                        <?php  
                    } ?>
            </select>
        </div>
        <select class = "formulaire deroulantFrais form-control champ-form deroulantId" name="note_id">
            <?php
            $uid = $sessionUser->getId();
            foreach ( (Note::getNotesByUser($bdd, $uid)) as $donnee ) {
                if ( 1 != $donnee['statut_id'] )
                    { continue; } ?>
                <option value="<?php echo $donnee['id'];?>" <?php if(isset($_POST[$noteid]) && !empty($_POST[$noteid]) && filter_input(INPUT_POST, $noteid) == $donnee['id'])
                    {echo "selected.='selected'";} ?>><?php echo $donnee['name'];?></option>
      <?php }  ?>
        </select>
        
        <select class = "formulaire deroulantFrais form-control champ-form deroulantId" name="categorie_id">
            <?php
            $reponseCategorie = CategorieFrais::getAllCategorie($bdd);
            while($donnee = $reponseCategorie->fetch())
            {
                ?>
                <option value ="<?php echo $donnee['id'];?>" <?php if(isset($_POST[$categori]) && !empty($_POST[$categori]) && filter_input(INPUT_POST, $categori) == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                <?php
            }
            $reponseCategorie->closeCursor();
            ?>
        </select>
        <br>
        <input class="btn btn-primary" type="submit" value="Valider" name = "valider"/>
    </p>
</form>
