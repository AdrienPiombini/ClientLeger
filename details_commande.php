<?php
 require_once("Controleur/config_bdd.php");
 require_once("Controleur/controleur.class.php");
$unControleur = new Controleur($serveur, $bdd, $user, $mdp);
$unControleur->setTable('details_commande');
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$une_commande = $unControleur->selectWhereAll('idcommande', $id);
    echo' <table class="table table-hover">
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
    echo "<tr></table>";
}

?>
