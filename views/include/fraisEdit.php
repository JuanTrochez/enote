
<h2>Ajout d'un nouveau frais</h2><br />

<form  class = "form" action="" method="POST" enctype="multipart/form-data">
    <p>
        <?php
        foreach($fraisEdit as $data){
            
        
        ?>
        <input class = "formulaire form-control champ-form" type="file" name="image" />
        <input class = "formulaire form-control champ-form formulaireReduit" type="date" max="<?php echo date('Y-m-d');?>" name="date" placeholder="aaaa/mm/jj" value="<?php echo $data['date'];  ?>"/>
        <textarea class = "formulaire form-control champ-form descriptionFormulaire" name="description" placeholder="Description"><?php echo $data['description']; ?></textarea>
        <div id ="blocPrix">
            <input class = "formulaire  formulairePrixTTC form-control champ-form" type="text" name="montant" placeholder="TTC" value="<?php echo $data['montant']; ?>"/>

            <select class = "formulaire formulairePrix form-control champ-form" name="devise_id">
                <?php
                $reponseDevise = $bdd->query('SELECT * FROM devise');
                while($donnee = $reponseDevise->fetch())
                {
                    ?>
                    <option value="<?php echo $donnee['id'];?>" <?php if($data['devise_id']== $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
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
                <option value="<?php echo $donnee['id'];?>" <?php if($data['note_id']== $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
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
                <option value ="<?php echo $donnee['id'];?>" <?php if($data['categorie_id'] == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                <?php
            }
            $reponseCategorie->closeCursor();
            ?>
        </select>
        
        <br>
        <input class="btn btn-primary" type="submit" value="Valider" name = "valider"/>
        <?php
        //fin de la boucle foreach fraisEdit
        }
        ?>
    </p>
</form>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

