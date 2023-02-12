<?php

 $unControleur->setTable('produit');
 if (isset($_POST['commander_produit'])){
	$unControleur->updateStock($_POST['qteproduit'], $_POST['idproduit']);
	echo "<br/>Le produit : ".$_POST['idproduit']." a bien était commandé ";  
//  }else{
// 	$les_produits = $unControleur->selectAll();
 }

 if (isset($_POST['filtrer_produits'])){
    $mot = $_POST['mot']; 
    $tab =  array("idProduit", "nomProduit", "quantite");
    $les_produits = $unControleur->selectLikeAll($mot, $tab); 
    require_once("Vue/espace_membre/vue_produits.php");
}else{
    $les_produits = $unControleur->selectAll(); 
    }
    if ( !isset($_SESSION['email'])){
        header("Location: index.php?page=6");
	}else if (isset($_SESSION['roles']) AND $_SESSION['roles']== 'admin'){
        require_once("Vue/espace_membre/vue_produits.php");
        }else (require_once("erreur404.php"));