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
        <input class = "formulaire form-control champ-form formulaireReduit" type="date" max="<?php echo date('Y-m-d');?>" name="date" placeholder="aaaa/mm/jj"/>
        <input class = "descriptionFormulaire formulaire form-control champ-form " type="text" name="description" placeholder="Description"/>
        <input class = "formulaire form-control champ-form formulaireReduit" type="text" name="montant" placeholder="TTC"/>
        
        <select class = "deroulantFrais form-control champ-form deroulantId" name="devise_id">
            <?php
            $reponseDevise = $bdd->query('SELECT * FROM devise');
            while($donnee = $reponseDevise->fetch())
            {
                ?>
                <option value="<?php echo $donnee['id'];?>"><?php echo $donnee['name'];?></option>
                <?php  
            }
            $reponseDevise->closeCursor();
            ?>
        </select>
        
        <select class = "deroulantFrais form-control champ-form deroulantId" name="note_id">
            <?php
            $reponseNote = $bdd->query('SELECT * FROM note_frais');
            while($donnee = $reponseNote->fetch())
            {
                ?>
                <option value="<?php echo $donnee['id'];?>"><?php echo $donnee['name'];?></option>
                <?php  
            }
            $reponseNote->closeCursor();
            ?>
        </select>
        
        <select class = "deroulantFrais form-control champ-form deroulantId" name="categorie_id">
            <?php
            $reponseCategorie = $bdd->query('SELECT * FROM categorie_frais');
            while($donnee = $reponseCategorie->fetch())
            {
                ?>
                <option value ="<?php echo $donnee['id'];?>"><?php echo $donnee['name'];?></option>
                <?php
            }
            $reponseCategorie->closeCursor();
            ?>
        </select>
        
        <br>
        <input class="btn btn-primary" type="submit" value="Valider" name = "valider"/>
    </p>
</form>
