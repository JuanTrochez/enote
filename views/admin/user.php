<a href="<?php echo $basePath ?>?page=admin&section=user&action=adduser" class="btn btn-primary">Ajouter un utilisateur</a>
<br/><br/>
<div class="admin-user">
    <table>
        <tr>
            <th>Nom</th>
            <th>Login</th>
            <th>Mail</th>
            <th>Role</th>
            <th>Devise</th>    
            <th>Actions</th>
        </tr>
        <?php foreach ($listUser as $user) { ?>
        <tr class="tr-user-<?php echo $user['id']; ?>">
            <td><?php echo $user['name']; ?></td>
            <td><?php echo $user['login']; ?></td>
            <td><?php echo $user['mail']; ?></td>
            <td><?php echo Role::getRoleById($bdd, $user['role_id'])->getName(); ?></td>
            <td><?php echo Devise::getDeviseById($bdd, $user['devise_id'])->getName(); ?></td>
            <td><button class="user-<?php echo $user['id']; ?> btn btn-danger">supprimer</button> <a class="btn btn-default" href="<?php echo $basePath ."?page=user&id=" . $user['id']; ?>">editer</a></td>
        </tr>
        <?php } ?>
    </table>
</div>
<br/>
<a href="<?php echo $basePath ?>?page=admin&section=user&action=adduser" class="btn btn-primary">Ajouter un utilisateur</a>