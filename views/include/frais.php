<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<h2>Ajout d'un nouveau frais</h2><br />

<form  class = "form" action="" method="POST" enctype="multipart/form-data">
    <p>
        <input class = "formulaire form-control champ-form" type="file" name="image" />
        <input class = "formulaire form-control champ-form formulaireReduit" type="date" max="<?php echo date('Y-m-d');?>" name="date" placeholder="aaaa/mm/jj" value="<?php if(isset($_POST['date']) && !empty($_POST['date'])){echo $_POST['date']; } ?>"/>
        <textarea class = "formulaire form-control champ-form descriptionFormulaire" name="description" placeholder="Description"><?php if(isset($_POST['description']) && !empty($_POST['description'])){echo $_POST['description']; } ?></textarea>
        <div id ="blocPrix">
            <input class = "formulaire  formulairePrixTTC form-control champ-form" type="text" name="montant" placeholder="TTC" value="<?php if(isset($_POST['montant']) && !empty($_POST['montant'])){echo $_POST['montant']; } ?>"/>

            <select class = "formulaire formulairePrix form-control champ-form" name="devise_id">
                <?php
                $reponseDevise = $bdd->query('SELECT * FROM devise');
                while($donnee = $reponseDevise->fetch())
                {
                    ?>
                    <option value="<?php echo $donnee['id'];?>" <?php if(isset($_POST['devise_id']) && !empty($_POST['devise_id']) && $_POST['devise_id'] == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                    <?php  
                }
                $reponseDevise->closeCursor();
                ?>
            </select>
        </div>
        <select class = "formulaire deroulantFrais form-control champ-form deroulantId" name="note_id">
            <?php
            $reponseNote = $bdd->query('SELECT * FROM note_frais WHERE statut_id = 1');
            while($donnee = $reponseNote->fetch())
            {
                ?>
                <option value="<?php echo $donnee['id'];?>" <?php if(isset($_POST['note_id']) && !empty($_POST['note_id']) && $_POST['note_id'] == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                <?php  
            }
            $reponseNote->closeCursor();
            ?>
        </select>
        
        <select class = "formulaire deroulantFrais form-control champ-form deroulantId" name="categorie_id">
            <?php
            $reponseCategorie = $bdd->query('SELECT * FROM categorie_frais');
            while($donnee = $reponseCategorie->fetch())
            {
                ?>
                <option value ="<?php echo $donnee['id'];?>" <?php if(isset($_POST['categorie_id']) && !empty($_POST['categorie_id']) && $_POST['categorie_id'] == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                <?php
            }
            $reponseCategorie->closeCursor();
            ?>
        </select>
        
        <br>
        <input class="btn btn-primary" type="submit" value="Valider" name = "valider"/>
    </p>
</form>
