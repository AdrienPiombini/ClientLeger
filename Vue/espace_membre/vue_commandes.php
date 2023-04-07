<link rel="stylesheet" href="css/tableau.css">
<link rel="stylesheet" href="css/compte.css">
<link rel="stylesheet" href="css/modal.css">

<p></p>
<br>


<br>
<h3>Liste des Commandes</h3>
<form method="post">
	<input type="text" name="mot">
	<input type="submit" name="rechercher_commande_en_cours" value="Rechercher">
</form>
<br>
<div >
<div class="container tbl-container">
<div class="row tbl-fixed">
<table class="table table-hover">
  <thead>
   <!-- /**********************ADMIN****************************** */  -->
  <?php if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){?>
    <tr>
      <th scope="col">Reference du panier</th>
      <th scope="col">Reference user</th>
      <th scope="col">Statut de la commande</th>
      <th scope="col">Quantite d'article</th>
      <th scope="col">Prix HT</th>
      <th scope="col">Prix TTC </th>
      <th scope="col">Date de la commande</th>
      <th scope="col">Details</th>
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
            echo '<td><a href="index.php?page=7&id='.$une_commande_en_cours['idcommande'].'&openModal=true"> Details</a></td> ';
            echo '<input type="hidden" name="idpanier" value="'.$une_commande_en_cours['idcommande'].'">';
            echo"<td><input type='submit' name='valider_commande' value='Valider'>
                        <input type='submit' name='annule_commande' value='Annuler'>
                        <input type='submit' name='archive_commande' value='Archiver'></td>";
            echo "<tr></form>";
        }
        ?>
  </tbody>
</table>
</div>
</div>

<h4 class="vue_commande">
Toutes les commandes sont disponible sous 48H, une fois validé elle seront disposnible en magasin et ce pendant 30 jours. Passé ce délais la commande sera considéré comme étant annulée.
</h4>

<h3>historique des commandes</h3>
<div class="container tbl-container">
<div class="row tbl-fixed">
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
    /**********************CLIENT TECHNICIEN****************************** */
}else{  ?>

</tbody>
</table>
</div>
</div>

<div class="container tbl-container">
<div class="row tbl-fixed">
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
      <th scope="col">Annuler la commande</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
<?php

//if(isset($btnAfficherCommande))

foreach($mes_commandes_en_cours as $mes_commande_en_cours){
    echo"<form method='post'><tr>";
    echo"<td>".$mes_commande_en_cours['idcommande']."</td>";
    echo"<td>".$mes_commande_en_cours['iduser']."</td>";
    echo"<td>".$mes_commande_en_cours['statut']."</td>";
    echo"<td>".$mes_commande_en_cours["nbArticle"]."</td>";
    echo"<td>".$mes_commande_en_cours["totalHT"]."</td>";
    echo"<td>".$mes_commande_en_cours["totalTTC"]."</td>";
    echo"<td>".$mes_commande_en_cours["datecommande"]."</td>";
    echo '<input type="hidden" name="idpanier" value="'.$mes_commande_en_cours['idcommande'].'">';
    echo"<td><input type='submit' name='annule_commande' value='Annuler'></td>";
    echo '<td><a href="index.php?page=7&id='.$mes_commande_en_cours['idcommande'].'&openModal=true"> Details</a></td> ';
    //echo '<td><input type="button" value='.$mes_commande_en_cours['idcommande'].' class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" name="btnAfficherCommande"></td>';
    //echo '<td><input type="button" onclick="getIdCommande(\''.$mes_commande_en_cours['idcommande'].'\')" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" value="detail"></td>';
    echo "</tr></form>"; 
}
?>

  </tbody>
</table>
</div>
</div>
<h4 class="vue_commande">
Toutes les commandes sont disponible sous 48H, une fois validé elle seront disposnible en magasin et ce pendant 30 jours. Passé ce délais la commande sera considéré comme étant annulée.
</h4>

<br>
<h3>historique des commandes</h3>
<div class="container tbl-container">
<div class="row tbl-fixed">
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



<div class='modal' id='modalFilelec'>
<h1>Details de la commande</h1>
<button type="button" onclick="document.getElementById('modalFilelec').style.display = 'none';">X</button>
  <div id="printableArea">
  <?php
  echo $_SESSION['nom'];
  $unControleur->setTable('details_commande');
      echo' 
      <div class="container tbl-container">
      <div class="row tbl-fixed">
      <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Référence commandes</th>
          <th scope="col">Nom du produit</th>
          <th scope="col">Prix du produit</th>
          <th scope="col">Quantité article</th>
          <th scope="col">Prix HT</th>
          <th scope="col">Prix TTC </th>
        </tr>
      </thead>
      <tbody>
          ';
      foreach($une_commande as $unArticle){
          echo "<tr>";
          echo"<td>".$unArticle['idcommande']."</td>";
          echo"<td>".$unArticle['nomProduit']."</td>";
          echo"<td>".$unArticle['prixProduit']."</td>";
          echo"<td>".$unArticle["quantiteproduit"]."</td>";
          echo"<td>".$unArticle["totalHT"]."</td>";
          echo"<td>".$unArticle["totalTTC"]."</td>";
      }
      echo "<tr></table></div></div>";

  ?>
  <div class='modalFooter'>
        <input class="btn btn-success btn-lg" type="button" onclick="printDiv('printableArea')" value="Imprimer la commande" />
</div>


<script type="text/javascript">
window.printDiv = function(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;
     document.body.innerHTML = printContents;
     window.print();
     document.body.innerHTML = originalContents;
}

const urlParams = new URLSearchParams(window.location.search); 
const openModal = urlParams.get('openModal'); 
if (openModal == "true") { 
  document.getElementById('modalFilelec').style.display = "block";
 }else{
  document.getElementById('modalFilelec').style.display = "none";
 }
</script>


<!-- Modal 
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Details de la commandes</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div id="">
      <div class="modal-body" id="modal-body">
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input class="btn btn-success btn-lg" type="button" onclick="printDiv('printableArea')" value="Imprimer les  commandes" />
      </div>
    </div>
  </div>


/*function getIdCommande(id) {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("modal-body").innerHTML = this.responseText;
    }
  };
  xmlhttp.open("GET", "details_commandes.php?id=" + id, true);
  xmlhttp.send();
}
*/
</div>-->