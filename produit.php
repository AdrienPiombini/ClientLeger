<br>
<?php
$unControleur->setTable('produit');
if (isset($_POST['filtrer_produit'])){
    $mot = $_POST['mot']; 
    $tab =  array("idProduit", "nomProduit", "prixProduit", "description");
    $produits = $unControleur->selectLikeAll($mot, $tab); 
    require_once("vue/produit/vue_produit.php");
}else{
    $produits = $unControleur->selectAll(); 
    }

require_once("Vue/produit/vue_produit.php");

?>