<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<form action="" method="POST" enctype="multipart/form-data">
    <p>
        Formulaire d'envoi de fichier :<br />
        <input type="file" name="image" /><br />
        <input type="date" name="date" placeholder="aaaa/mm/jj"/>
        <input type="text" name="description" placeholder="Description"/>
        <br>
        <input type="text" name="montant" placeholder="TTC"/>
        
        <select name="devise_id">
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
        <br>
        
        <select name="note_id">
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
        <br>
        
        <select name="categorie_id">
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
        <input type="submit" value="Envoyer le fichier" />
    </p>
</form>
