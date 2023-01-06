<!-- <h1>Gestion des utilisateurs</h1> -->
<link rel="stylesheet" href="css/tableau.css">
<link rel="stylesheet" href="css/form_insert.css">

<br><br>
<h3> Ajout d'un utilisateur</h3>
<br>
<div class="box-insert">

<form method="post">
    <br>
        <div class="label">
            <p><label>
            <input type="email" name="email" placeholder="email" value="<?= ($one_user != null) ? $one_user['email']:''?>">
            </label></p>
        
			 <p><label>
            <input type="password" name="mdp" placeholder="Mot de passe" value="<?= ($one_user != null) ? $one_user['mdp']:''?>">
            </label></p>
        
            <p><label> 
                <select name="roles" required>
                    <option value="<?= ($one_user != null) ? $one_user['roles']:'Choisir un rôle utilisateur'?>"><?= ($one_user != null) ? $one_user['roles']:'Choisir un rôles utilisateur'?></option>
                    <option value="client">Client</option>
                    <option value="technicien">Technicien</option>
                    <option value="admin">Administrateur</option>
                </select>
            </label></p>
            <p><br>
            <input type="hidden" name="iduser"  value="<?= ($one_user != null) ? $one_user['iduser']:''?>">
            <input type="submit" <?=($one_user != null) ? 'name="modifier_user" value="Modifier"'  : 'name="ajouter_user" value="Ajouter"'?>>
</p>
    </div>
</form>
<br>    
</div>
<br>
<h3>Liste des utilisateurs</h3>
<form method="post">
	<input type="text" name="mot">
	<input type="submit" name="rechercher_user" value="Rechercher">
</form>
<br>

<div class="table-box">
    <table border="1">
        <tr>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;"></td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Iduser</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prenom</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Roles</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Action</td>
            
            
        </tr>

        <?php
        foreach($les_users as $un_user){
            echo"<form method='post'><tr>";
            echo"<td><img src='img/user.png'></td>";
            echo"<td>".$un_user['iduser']."</td>";
            echo"<td>".$un_user['email']."</td>";
            echo"<td>".$un_user['roles']."</td>";
            echo '<input type="hidden" name="iduser" value="'.$un_user['iduser'].'">';
            echo"<td><input type='submit' name='delete_user' value='Supprimer'>
                        <input type='submit' name='edit_user' value='Modifier'></td>";
            echo "<tr></form>";

        }
        ?>
    </table>
    </div>
