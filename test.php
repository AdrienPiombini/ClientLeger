<?php
 require_once("Controleur/config_bdd.php");
 require_once("Controleur/controleur.class.php");
$unControleur = new Controleur($serveur, $bdd, $user, $mdp);
$unControleur->setTable('details_commande');
if(isset($_GET['id'])){
	$id = $_GET['id'];
	$une_commande = $unControleur->selectWhereAll('idcommande', $id);
    foreach($une_commande as $unArticle){
        echo"<form method='post'><tr>";
        echo"<td>".$unArticle['idcommande']."</td>";
        echo"<td>".$unArticle['nomProduit']."</td>";
        echo"<td>".$unArticle['prixProduit']."</td>";
        echo"<td>".$unArticle["quantiteproduit"]."</td>";
        echo"<td>".$unArticle["totalHT"]."</td>";
        echo"<td>".$unArticle["totalTTC"]."</td>";
        echo "<tr></form>";
    }
	}

?>
