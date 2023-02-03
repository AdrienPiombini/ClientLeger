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
<div>
<table class="table table-hover">
  <thead>
    <?php
    if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){?> 
    <tr>
      <th scope="col">Idintervention</th>
      <th scope="col">Iduser</th>
      <th scope="col"> Nom Client</th>
      <th scope="col"> Libelle</th>
      <th scope="col">Date intervention</th>
      <th scope="col">Nom technicien</th>
      <th scope="col">Statut</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
        <?php  
        foreach($les_interventions_enCours as $une_intervention_enCours){
            echo"<form method='post'><tr>";
            echo"<td>".$une_intervention_enCours['idintervention']."</td>";
            echo"<td>".$une_intervention_enCours['iduser']."</td>";
            echo"<td>".$une_intervention_enCours['nomClient']."</td>";
            echo"<td>".$une_intervention_enCours['libelle']."</td>";
            echo"<td>".$une_intervention_enCours['dateintervention']."</td>";
            echo"<td>".$une_intervention_enCours['nomTech']."</td>";
            echo"<td>".$une_intervention_enCours['statut']."</td>";
            echo '<input type="hidden" name="idintervention" value="'.$une_intervention_enCours['idintervention'].'">';
            echo"<td><input type='submit' name='valider_intervention' value='Valider'>
            <input type='submit' name='annule_intervention' value='Annuler'>
            <input type='submit' name='edit_intervention' value='Modifier'>
            <input type='submit' name='archive_intervention' value='Archiver'></td>";
            echo "<tr></form>";
        }
        ?>
    </table>
    </div>
<br>
    <h3>historique des interventions</h3>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Idintervention</th>
      <th scope="col">Iduser</th>
      <th scope="col">Nom client</th>
      <th scope="col"> Libelle</th>
      <th scope="col">Date intervention</th>
      <th scope="col">Nom technicien</th>
      <th scope="col">Statut</th>
    </tr>
  </thead>
  <tbody>
        <?php
        foreach($les_interventions_archive as $une_intervention_archive){
            echo"<form method='post'><tr>";
            echo"<td>".$une_intervention_archive['idintervention']."</td>";
            echo"<td>".$une_intervention_archive['iduser']."</td>";
            echo"<td>".$une_intervention_archive['nomClient']."</td>";
            echo"<td>".$une_intervention_archive['libelle']."</td>";
            echo"<td>".$une_intervention_archive['dateintervention']."</td>";
            echo"<td>".$une_intervention_archive['nomTech']."</td>";
            echo"<td>".$une_intervention_archive['statut']."</td>";
            echo '<input type="hidden" name="idintervention" value="'.$une_intervention_archive['idintervention'].'">';
            echo "<tr></form>";
        }
    }else{
        ?>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Email user </th>
      <th scope="col"> Libelle</th>
      <th scope="col">Date intervention</th>
      <th scope="col"> Statut</th>
      <th scope="col">Annuler l'intervention</th>
    </tr>
  </thead>
  <tbody>
          <?php 
        foreach($mes_interventions_enCours as $une_intervention_enCours){
            echo"<form method='post'><tr>";
            echo"<td>".$une_intervention_enCours['email']."</td>";
            echo"<td>".$une_intervention_enCours['libelle']."</td>";
            echo"<td>".$une_intervention_enCours['dateintervention']."</td>";
            echo"<td>".$une_intervention_enCours['statut']."</td>";
            echo '<input type="hidden" name="idintervention" value="'.$une_intervention_enCours['idintervention'].'">';
            echo"<td><input type='submit' name='annule_intervention' value='Annuler'></td>";
            echo "<tr></form>";
    }
    ?>
  </tbody>
    </table>
    </div>
<br>
    <h3>historique des interventions</h3>
    <table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Email user </th>
      <th scope="col"> Libelle</th>
      <th scope="col">Date intervention</th>
      <th scope="col"> Statut</th>
    </tr>
  </thead>
  <tbody>
        <?php
        foreach($mes_interventions_archive as $une_intervention_archive){
            echo"<form method='post'><tr>";
            echo"<td>".$une_intervention_archive['email']."</td>";
            echo"<td>".$une_intervention_archive['libelle']."</td>";
            echo"<td>".$une_intervention_archive['dateintervention']."</td>";
            echo"<td>".$une_intervention_archive['statut']."</td>";
            echo '<input type="hidden" name="idintervention" value="'.$une_intervention_archive['idintervention'].'">';
            echo "<tr></form>";
    }

}
    ?>
    </table>
</div>

