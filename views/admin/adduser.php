<?php
include_once 'class/Role.php';
?>
<div style="text-align: center">
    <form class = "form" action="" method="POST" enctype="multipart/form-data">
        <input class="form-control champ-form" name="name_user" type="text" placeholder="Nom">
        <input class="form-control champ-form" name="log" type="text" placeholder="Login">
        <input class="form-control champ-form" name="pwd" type="password" placeholder="Mot de passe">
        <input class="form-control champ-form" name="pwd2" type="password" placeholder="Confirmer le mot de passe">
        <input class="form-control champ-form" name="email" type="text" placeholder="Email">
        <select class = "formulaire formulaireRole form-control champ-form" style="margin-left: 0%; display: inline-block;" name="role">
            <?php
                $reponseRole = Role::getAllRole($bdd);
                while($donnee = $reponseRole->fetch())
                { ?>
                    <option value="<?php echo $donnee['id'];?>"><?php echo $donnee['name'];?></option>
          <?php } ?>
        </select>
        <select class = "formulaire formulairePrix form-control champ-form" style="display: inline-block;" name="devise">
            <?php
            $reponseDevise = Devise::getAllDevise($bdd);
            while($donnee = $reponseDevise->fetch())
            { ?>
                <option value="<?php echo $donnee['id'];?>" <?php if($sessionUser->getDevise() == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
      <?php } ?>
        </select>
        <input class = "btn btn-primary" type="submit" name="Ajouter" value="Ajouter"/>
    </form> 

    
</div>