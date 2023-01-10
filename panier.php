<?php 
require_once("vue/vue_panier.php");

if (isset($_POST['valider_panier']))
{
    $unControleur->setTable('panier');
    $idpanier = $unControleur->valider_panier();
    foreach($produits as $produit){   
        echo  $idpanier[0],$_SESSION['iduser'], $produit->idProduit, $_SESSION['panier'][$produit->idProduit];
        echo ' ';
    }
    

}else{

    }
?>

