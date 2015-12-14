<?php include_once 'class/Devise.php';
      include_once 'class/Role.php';
?>

<?php
if(isset($_GET['id']) && Security::isAdmin($bdd))
{
    $CloneUser= User::getUserById($bdd, $_GET['id']);
?>
    <h2> Bienvenue dans votre espace d'administrateur <?php echo $sessionUser->getName(); ?> </h2>
    <br/>
    <h3> <strong>Voici quelques informations concernant le compte de l'utilisateur : </strong></h3><br/>
    <div>
        <strong>Nom de l'utilisateur</strong> : <?php echo $CloneUser->getName(); ?><br/>
        <strong>Login de l'utilisateur</strong> : <?php echo $CloneUser->getLogin(); ?><br/>
        <strong>Email de l'utilisateur</strong> : <?php echo $CloneUser->getEmail(); ?><br/>
        <?php 
        $Devise = new Devise();
        $Devise = Devise::getDeviseById($bdd,$CloneUser->getDevise());
        ?>
        <strong>Devise actuelle de l'utilisateur</strong> : <?php echo $Devise->getName() ;?>
    </div>

    <div>
        <h2> Modification des informations personnelle</h2><br/>
        <h4> <strong>Modifications des informations </strong></h4><br/>
    </div>

    <form  class = "form" action="" method="POST" enctype="multipart/form-data">
        Changer le nom de l'utilisateur :  <input class = "form-control champ-form" type="text" name="changerNomUser" value='<?php echo $CloneUser->getName()?>'/><br/>
        Changer le login de l'utilisateur :  <input class = "form-control champ-form" type="text" name="changerLoginUser" value='<?php echo $CloneUser->getLogin()?>'/><br/>
        Changer l'email de l'utilisateur :  <input class = "form-control champ-form" type="text" name="changerMailUser"value='<?php echo $CloneUser->getEmail()?>'/><br/>
        Changer le role de l'utilisateur :
        <select class = "formulaireRole form-control champ-form" name="changerRoleUser">
            <?php
                $reponseRole = Role::getAllRole($bdd);
                var_dump($reponseRole);
                while($donnee = $reponseRole->fetch())
                    {
                        ?>
            <option value="<?php echo $donnee['id'];?>" <?php if($CloneUser->getRole() == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                        <?php  
                    }
            ?>
        </select>
        <br/>
        Nouveau mot de passe (facultatif) :  <input class = "form-control champ-form" type="password" name="nouveauMdpAdmin"/> <br/>
        Confirmer le nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="confirmationMdpAdmin"/><br/>
        Nouvelle devise :
        <select class = "formulaire formulairePrix form-control champ-form" name="devise_idAdmin">
            <?php
                $reponseDevise = Devise::getAllDevise($bdd);
                while($donnee = $reponseDevise->fetch())
                    {
                        ?>
            <option value="<?php echo $donnee['id'];?>" <?php if($CloneUser->getDevise() == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
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
            <strong>Votre nom</strong> : <?php echo $sessionUser->getName(); ?><br/>
            <strong>Votre Login</strong> : <?php echo $sessionUser->getLogin(); ?><br/>
            <strong>Votre Email</strong> : <input class = "formulaireEmail form-control champ-form" type="text" name="nouveauMail" value='<?php echo $sessionUser->getEmail(); ?>'/>
            <input class = "btn btn-primary" type="submit" name="changementEmailUser" value="Modifier"/>
            <br/>
            <?php 
            $Devise = new Devise();
            $Devise = Devise::getDeviseById($bdd,$sessionUser->getDevise());
            ?>
            <strong>Votre devise actuelle</strong> : 
            <select class = "formulaire formulaireDevise form-control champ-form" name="devise_id">
                        <?php
                        $reponseDevise = Devise::getAllDevise($bdd);
                        while($donnee = $reponseDevise->fetch())
                        {
                            ?>
                            <option value="<?php echo $donnee['id'];?>" <?php if($sessionUser->getDevise() == $donnee['id']){echo "selected='selected'"; } ?>><?php echo $donnee['name'];?></option>
                            <?php  
                        }
                        ?>
            </select>
            <input class = "btn btn-primary" type="submit" name="changementDeviseUser" value="Modifier"/>
        </form>
    </div>

    <div>
        <h2> Modification des informations personnelle</h2><br/>
        <h4> <strong>Modifications des informations </strong></h4><br/>
    </div>

    <form  class = "form" action="" method="POST" enctype="multipart/form-data">
        Ancien mot de passe :  <input class = "form-control champ-form" type="password" name="ancienMdp"/><br/>
        Nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="nouveauMdp"/> <br/>
        Confirmer le nouveau mot de passe :  <input class = "form-control champ-form" type="password" name="confirmationMdp"/><br/>
        <input class = "btn btn-primary" type="submit" name="changementParamUser" value="Modifier"/><br/>
    </form>
<?php
}
?>