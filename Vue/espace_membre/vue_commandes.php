<div class = "Test" >
<p></p>
<br>

<h4>
Toutes les commandes sont disponible sous 48H, une fois validé elle seront disposnible en magasin et ce pendant 30 jours. Passé ce délais la commande sera considéré comme étant annulée
</h4>
<br>
<h3>Liste des Commandes</h3>
<form method="post">
	<input type="text" name="mot">
	<input type="submit" name="rechercher_commande_en_cours" value="Rechercher">
</form>
<br>
<div id="printableArea">
<table class="table table-hover">
  <thead>
  <?php if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){?>
    <tr>
      <th scope="col">Reference du panier</th>
      <th scope="col">Reference user</th>
      <th scope="col">Statut de la commande</th>
      <th scope="col">Quantite d'article</th>
      <th scope="col">Prix HT</th>
      <th scope="col">Prix TTC </th>
      <th scope="col">Date de la commande</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  <?php
        foreach($les_commandes_en_cours as $une_commande_en_cours){
            echo"<form method='post'><tr>";
            echo"<td>".$une_commande_en_cours['idcommande']."</td>";
            echo"<td>".$une_commande_en_cours['iduser']."</td>";
            echo"<td>".$une_commande_en_cours['statut']."</td>";
            echo"<td>".$une_commande_en_cours["nbArticle"]."</td>";
            echo"<td>".$une_commande_en_cours["totalHT"]."</td>";
            echo"<td>".$une_commande_en_cours["totalTTC"]."</td>";
            echo"<td>".$une_commande_en_cours["datecommande"]."</td>";
            echo '<input type="hidden" name="idpanier" value="'.$une_commande_en_cours['idcommande'].'">';
            echo"<td><input type='submit' name='valider_commande' value='Valider'>
                        <input type='submit' name='annule_commande' value='Annuler'>
                        <input type='submit' name='archive_commande' value='Archiver'></td>";
            echo "<tr></form>";
        }
        ?>
  </tbody>
</table>
<h3>historique des commandes</h3>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Référence commandes</th>
      <th scope="col">Référence user</th>
      <th scope="col">Statut</th>
      <th scope="col">Quantité article</th>
      <th scope="col">Prix HT</th>
      <th scope="col">Prix TTC </th>
      <th scope="col">Date Commande</th>
    </tr>
  </thead>
  <tbody>
  <?php
        foreach($les_commandes_archives as $une_commande_archive){
            echo"<form method='post'><tr>";
            echo"<td>".$une_commande_archive['idcommande']."</td>";
            echo"<td>".$une_commande_archive['iduser']."</td>";
            echo"<td>".$une_commande_archive['statut']."</td>";
            echo"<td>".$une_commande_archive["nbArticle"]."</td>";
            echo"<td>".$une_commande_archive["totalHT"]."</td>";
            echo"<td>".$une_commande_archive["totalTTC"]."</td>";
            echo"<td>".$une_commande_archive["datecommande"]."</td>";
            echo '<input type="hidden" name="iduser" value="'.$une_commande_archive['idcommande'].'">';
            echo "<tr></form>";
        }
}else{  ?>
</tbody>
</table>

<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Reference du panier</th>
      <th scope="col">Reference user</th>
      <th scope="col">Statut de la commande</th>
      <th scope="col">Quantite d'article</th>
      <th scope="col">Prix HT</th>
      <th scope="col">Prix TTC </th>
      <th scope="col">Date de la commande</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($mes_commandes_en_cours as $mes_commande_en_cours){
    echo"<form method='post'><tr>";
    echo"<td>".$mes_commande_en_cours['idcommande']."</td>";
    echo"<td>".$mes_commande_en_cours['iduser']."</td>";
    echo"<td>".$mes_commande_en_cours['statut']."</td>";
    echo"<td>".$mes_commande_en_cours["nbArticle"]."</td>";
    echo"<td>".$mes_commande_en_cours["totalHT"]."</td>";
    echo"<td>".$mes_commande_en_cours["totalTTC"]."</td>";
    echo"<td>".$mes_commande_en_cours["datecommande"]."</td>";
    echo '<input type="hidden" name="iduser" value="'.$mes_commande_en_cours['idcommande'].'">';
    echo "</tr></form>"; 
}
?>

  </tbody>
</table>


<br>
<h3>historique des commandes</h3>
<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Référence commandes</th>
      <th scope="col">Référence user</th>
      <th scope="col">Statut</th>
      <th scope="col">Quantité article</th>
      <th scope="col">Prix HT</th>
      <th scope="col">Prix TTC </th>
      <th scope="col">Date Commande</th>
    </tr>
  </thead>
  <tbody>
<?php
foreach($mes_commandes_archives as $mes_commande_archive){
    echo"<form method='post'><tr>";
    echo"<td>".$mes_commande_archive['idcommande']."</td>";
    echo"<td>".$mes_commande_archive['iduser']."</td>";
    echo"<td>".$mes_commande_archive['statut']."</td>";
    echo"<td>".$mes_commande_archive["nbArticle"]."</td>";
    echo"<td>".$mes_commande_archive["totalHT"]."</td>";
    echo"<td>".$mes_commande_archive["totalTTC"]."</td>";
    echo"<td>".$mes_commande_archive["datecommande"]."</td>";
    echo '<input type="hidden" name="iduser" value="'.$mes_commande_archive['idcommande'].'">';
    echo "<tr></form>";
}
}
 ?>
    </table>
    </div>

</div>
</div>
<td colspan="2"><input class="btn btn-success btn-lg" type="button" onclick="printDiv('printableArea')" value="Imprimer les  commandes" /></td>

<script type="text/javascript">
window.printDiv = function(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>


<style>

  </style>

