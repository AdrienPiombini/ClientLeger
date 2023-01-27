<link rel="stylesheet" href="css/form_insert.css">

<h3> Modifier ses informations</h3>
<br>
<div class="box-insert">

<form method="post">
    <br>
        <div class="label">
            <p><label>
            <input type="email" name="email" placeholder="email" value="<?= ($one_user != null) ? $one_user['email']:''?>">
            </label></p>
        
			 <p><label>
            <input type="text" name="nom" placeholder="Nom" value="<?= ($one_user != null) ? $one_user['nom']:''?>">
            </label></p>
            <p><label>
            <input type="text" name="adresse" placeholder="Adresse" value="<?= ($one_user != null) ? $one_user['adresse']:''?>">
            </label></p>
            <p><label>
            <input type="text" name="ville" placeholder="Ville" value="<?= ($one_user != null) ? $one_user['ville']:''?>">
            </label></p>
            <p><label>
            <input type="text" name="cp" placeholder="Code postal" value="<?= ($one_user != null) ? $one_user['cp']:''?>">
            </label></p>
            <p><br>
            <input type="hidden" name="iduser"  value="<?= ($one_user != null) ? $one_user['iduser']:''?>">
            <input type="submit" <?=($one_user != null) ? 'name="modifier_user" value="Modifier"'  : 'name="ajouter_user" value="Ajouter"'?>>
</p>
    </div>
</form>
<br>    
</div>

<!-- <h1>Gestion du compte</h1> -->
<br><br>
<h3>Modifier le mot de passe</h3>
<br>
<div class="box-insert">

<form method='post'>
    <br>
    <div class="label">
            <p><label>
            <input type="password" name='old_mdp' placeholder="Mot de passe actuel"></label></p>
       
            <p><label>
            <input type="password" name='new_mdp' placeholder="Nouveau mot de passe"></label></p>
        
            <p><label>
            <input type="password" name='new_mdp_verif' placeholder="Confirmer"></label></p>
        
        <p><br><input type="submit" name='edit_mdp' value="Changer le mdp"></p>
        <br>
        <br>
        <br>
        <?php echo  '<input type="hidden" name="iduser" value="'.$_SESSION['iduser'].'">'; ?>
        <p><br><input type="submit" name='delete_user' value="Supprimer son compte"></p>

    </div>
</form>
<br>
</div>