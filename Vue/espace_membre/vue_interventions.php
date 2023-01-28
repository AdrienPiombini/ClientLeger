<!-- <h1>Gestion des interventions</h1> -->
<link rel="stylesheet" href="css/tableau.css">
<link rel="stylesheet" href="css/form_insert.css">

<br><br>
<h3> Ajout d'une intervention</h3>
<br>
<div class="box-insert">

<form method="post">
	<br>
    <div class="label">
			<p>
                <label>
                    <select name="iduser" required style="width: 225px;">
                        <?php 
                            if (isset($_SESSION) && $_SESSION['roles']==='admin'){
                        ?><option value="<?= ($one_intervention!= null) ? $one_intervention['iduser'] : 'Choisir un utilisateur'?>"><?= ($one_intervention!= null) ? $one_intervention['nomClient'] : 'Choisir un utilisateur'?></option><?php
                                foreach($les_users as $un_user){echo '<option value="'.$un_user['iduser'].'">'.$un_user['email'].'</option>'; }

                            }elseif (isset($_SESSION) && $_SESSION['roles']==='client'){
                                echo '<option value="'.$_SESSION['iduser'].'">'.$_SESSION['email'].'</option>';
                            }
                        ?>
                    </select>
                </label>
            </p>
			<p>
                <label>
                    <select name="idtechnicien" style="width: 225px;">
                        <option value="<?= ($one_intervention!= null) ? $one_intervention['iduser'] : 'Choisir un techicien'?>"><?= ($one_intervention!= null) ? $one_intervention['nomTech'] : 'Choisir un technicien'?></option><?php
                                foreach($lesTechniciens as $unTechnicien){echo '<option value="'.$unTechnicien['iduser'].'">'.$unTechnicien['nom'].'</option>'; }?>
                    </select>
                </label>
            </p>  
            <select name="libelle" style="width: 225px;">
                        <option value="<?= ($one_intervention!= null) ? $one_intervention['libelle'] : 'Choisir une intervention'?>"><?= ($one_intervention!= null) ? $one_intervention['libelle'] : "Choisir une intervention"?></option>
                        <option value="diagnostic">Diagnostic à partir de 39.99</option>
                        <option value="vidange">Vidange à partir de 59.99</option>
                        <option value="controle">Controle Technique 78€</option>
                    </select>
	
           <p>
                <label> <input type="date" name='dateintervention'  min="<?php echo date('Y-m-d'); ?>" value="<?= ($one_intervention!= null) ? $one_intervention['dateintervention']:''?>" ></label>
            </p>
            
            <p>
                <br><input type="hidden" name="idintervention"  value="<?= ($one_intervention != null) ? $one_intervention['idintervention']:''?>"> 
                <input type="submit" <?=($one_intervention!= null) ? 'name="modifier_intervention" value="Modifier"'  : 'name="ajouter_intervention" value="Ajouter"'?>>
            </p>
    </div>
</form>
<br>
</div>
<br>    

<h3>Liste des interventions</h3>
<form method="post">
	<input type="text" name="mot">
	<input type="submit" name="rechercher_intervention" value="Rechercher">
</form>
<br>
    <div class="table-box">
    <table cellpadding="10">

    <?php
    if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){
           ?> 
        <tr>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Idinternvention</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Iduser</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Nom client </td>                    
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Libelle</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Date intervention</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Nom technicien</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Statut</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Action</td>

        </tr>
        <?php  
        foreach($les_interventions as $une_intervention){
            echo"<form method='post'><tr>";
            echo"<td>".$une_intervention['idintervention']."</td>";
            echo"<td>".$une_intervention['iduser']."</td>";
            echo"<td>".$une_intervention['nomClient']."</td>";
            echo"<td>".$une_intervention['libelle']."</td>";
            echo"<td>".$une_intervention['dateintervention']."</td>";
            echo"<td>".$une_intervention['nomTech']."</td>";
            echo"<td>".$une_intervention['statut']."</td>";
            echo '<input type="hidden" name="idintervention" value="'.$une_intervention['idintervention'].'">';
            echo"<td><input type='submit' name='delete_intervention' value='Supprimer'>
            <input type='submit' name='edit_intervention' value='Modifier'></td>";
            echo "<tr></form>";
        }
    }else{
        ?>
        <tr>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Email user</td>                    
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Libelle</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Date intervention</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Action</td>
        </tr> 
          <?php 
        foreach($mes_interventions as $une_intervention){
            echo"<form method='post'><tr>";
            echo"<td>".$une_intervention['email']."</td>";
            echo"<td>".$une_intervention['libelle']."</td>";
            echo"<td>".$une_intervention['dateintervention']."</td>";
            echo '<input type="hidden" name="idintervention" value="'.$une_intervention['idintervention'].'">';
            echo"<td><input type='submit' name='delete_intervention' value='Supprimer'>
            <input type='submit' name='edit_intervention' value='Modifier'></td>";
            echo "<tr></form>";
    }
}
    ?>
    </table>
</div>

