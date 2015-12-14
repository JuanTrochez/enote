  <?php
  include_once 'class/Statut.php';
  include_once 'class/Role.php';
  include_once 'class/Note.php';

        if (isset($_GET["id"]) && Security::isAdmin($bdd)) { ?>
            
            <h2>Edition d'une note de frais</h2>
            <br/>
            <form class="form" action="" method="POST" name="edit">
            <input class="form-control champ-form" name="name_note" type="text" value="<?php echo Note::getNameNote($bdd, $_GET['id']); ?>">
            <select class = "formulaire form-control champ-form" name="statut">
            <?php
                $reponseStatut = Statut::getAllStatut($bdd);
                while($donnee = $reponseStatut->fetch())
                { ?>
                    <option value="<?php echo $donnee['id'];?>"><?php echo $donnee['name'];?></option>
          <?php } ?>
            </select>
            <input class="btn btn-primary" name="Editer" type="submit" value="Editer">
            <a href="<?php echo $basePath; ?>" class="btn btn-primary">Annuler</a>
                    
  <?php } 
        elseif (isset($_GET["id"])) { ?>
            
            <h2>Modification d'une note de frais</h2>
            <br/>
            <form class="form" action="" method="POST" name="modif">
            <input class="form-control champ-form" name="name_note" type="text" value="<?php echo Note::getNameNote($bdd, $_GET['id']); ?>">
            <label class="envoi_note"><input name="cloturer" type="checkbox">Cloturer et envoyer la note</label>
            <input class="btn btn-primary" name="modifier" type="submit" value="Modifier">
            <a href="<?php echo $basePath; ?>" class="btn btn-primary">Annuler</a>
                    
  <?php } 
        else { ?>
            <h2>Ajout d'une nouvelle note de frais</h2>
            <br/>
            <form class="form" action="" method="POST">
                
            <input class="form-control champ-form" name="name_note" type="text" placeholder="Libellé">
            <input class="btn btn-primary" name="valider" type="submit" value="Valider">
  <?php } ?>

</form>