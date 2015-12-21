<?php include_once 'class/Devise.php';
      include_once 'class/Role.php';
      
      $selected = "selected='selected'";
?>

<?php
if(isset($_GET['id']) && (Security::isAdmin($bdd) || $secu->isManager($bdd)))
{
    $CloneUser= User::getUserById($bdd, $_GET['id']);
?>
    <h2> Bienvenue dans votre espace d'administrateur <?php echo $sessionUser->getName(); ?> </h2>
    <br/>
    <h3> <strong>Voici quelques informations concernant le compte de l'utilisateur : </strong></h3><br/>
    <div>
        <span class="bandblue">Nom de l'utilisateur</span> : <?php echo $CloneUser->getName(); ?><br/>
        <span class="bandblue">Login de l'utilisateur</span> : <?php echo $CloneUser->getLogin(); ?><br/>
        <span class="bandblue">Email de l'utilisateur</span> : <?php echo $CloneUser->getEmail(); ?><br/>
        <?php 
        $Devise = new Devise();
        $Devise = Devise::getDeviseById($bdd,$CloneUser->getDevise());
        ?>
        <span class="bandblue">Devise actuelle de l'utilisateur</span> : <?php echo $Devise->getName() ;?>
    </div>

    <div style="text-align: center">
        <br/>
        <h3> <strong>Modifications des informations personnelles</strong></h3><br/>
    </div>

    <form  class = "form" action="" method="POST" enctype="multipart/form-data">
        Changer le nom de l'utilisateur :  <input class = "form-control champ-form" type="text" name="changerNomUser" value='<?php echo $CloneUser->getName()?>'/>
        Changer le login de l'utilisateur :  <input class = "form-control champ-form" type="text" name="changerLoginUser" value='<?php echo $CloneUser->getLogin()?>'/>
        Changer l'email de l'utilisateur :  <input class = "form-control champ-form" type="text" name="changerMailUser"value='<?php echo $CloneUser->getEmail()?>'/>
        <?php if ($secu->isAdmin($bdd)) { ?>
            Changer le role de l'utilisateur :
            <select class = "formulaireRole form-control champ-form" name="changerRoleUser">
                <?php
                    $reponseRole = Role::getAllRole($bdd);
                    var_dump($reponseRole);
                    while($donnee = $reponseRole->fetch())
                        {
                            if ($secu->isManager($bdd) && $donnee['id'] == 1) {
                                continue;
                            }
                            ?>
                <option value="<?php echo $donnee['id'];?>" <?php if($CloneUser->getRole() == $donnee['id']){echo $selected; } ?>><?php echo $donnee['name'];?></option>
                            <?php  
                        }
                ?>
            </select>
        <?php } else { ?>
            <input type="hidden" value="1" name="changerRoleUser" />
        <?php } ?>
        Nouveau mot de passe (facultatif) :  <input class = "form-control champ-form" type="password" name="nouveauMdpAdmin"/>
        Confirmer le nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="confirmationMdpAdmin"/>
        Nouvelle devise :
        <select class = "formulaire formulairePrix form-control champ-form" name="devise_idAdmin">
            <?php
                $reponseDevise = Devise::getAllDevise($bdd); 
                while($donnee = $reponseDevise->fetch())
                    {
                        ?>
            <option value="<?php echo $donnee['id'];?>" <?php if($CloneUser->getDevise() == $donnee['id']){echo $selected; } ?>><?php echo $donnee['name'];?></option>
                        <?php  
                    }
            ?>
        </select>
        <br/>
        <input class = "btn btn-primary" type="submit" name="changementParamUserByAdmin" value="Modifier"/><br/>
    </form>
<?php
}else{
?>   
    
    <h2> Bienvenue dans votre espace personnel <?php echo $sessionUser->getName(); ?> </h2>
    <br/>
    <h3> <strong>Voici quelques informations concernant votre compte : </strong></h3><br/>

    <div>
        <form action="" method="POST" enctype="multipart/form-data">
            <span class="bandblue">Votre nom</span> : <?php echo $sessionUser->getName(); ?><br/>
            <span class="bandblue">Votre Login</span> : <?php echo $sessionUser->getLogin(); ?><br/>
            <span class="bandblue">Votre Email</span> : <input class = "formulaireEmail formprofil" type="text" name="nouveauMail" value='<?php echo $sessionUser->getEmail(); ?>'/>
            <input class = "btnmodif" type="submit" name="changementEmailUser" value="Modifier"/>
            <br/>
            <?php 
            $Devise = new Devise();
            $Devise = Devise::getDeviseById($bdd,$sessionUser->getDevise());
            ?>
            <span class="bandblue">Votre devise actuelle</span> : 
            <select class = "formulaire formulaireDevise formprofil" name="devise_id">
                        <?php
                        $reponseDevise = Devise::getAllDevise($bdd);
                        while($donnee = $reponseDevise->fetch())
                        {
                            ?>
                            <option value="<?php echo $donnee['id'];?>" <?php if($sessionUser->getDevise() == $donnee['id']){echo $selected; } ?>><?php echo $donnee['name'];?></option>
                            <?php  
                        }
                        ?>
            </select>
            <input class = "btnmodif" type="submit" name="changementDeviseUser" value="Modifier"/>
        </form>
    </div>

    <div style="text-align: center">
        <br/><br/>
        <h3><strong>Modification du mot de passe</strong></h3><br/>
    </div>

    <form  class = "form" action="" method="POST" enctype="multipart/form-data">
        Ancien mot de passe :  <input class = "form-control champ-form" type="password" name="ancienMdp"/>
        Nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="nouveauMdp"/>
        Confirmer le nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="confirmationMdp"/>
        <input class = "btn btn-primary" type="submit" name="changementParamUser" value="Modifier"/>
    </form>
<?php
}
?>