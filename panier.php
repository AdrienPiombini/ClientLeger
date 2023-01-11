<?php 
require_once("vue/vue_panier.php");

if (isset($_POST['valider_panier']))
{
    if (isset($_SESSION['email'])){
    $unControleur->setTable('panier');
    $idpanier = $unControleur->idpanier();
    foreach($produits as $produit){   
        $unControleur->insert_panier($idpanier[0],$_SESSION['iduser'], $produit->idProduit, $_SESSION['panier'][$produit->idProduit]);
    }
    unset($_SESSION['panier']);
    echo '<script language="Javascript">
    <!--
    document.location.replace("index.php?page=3");
    // -->
    </script>';
    }else {
        echo '<script language="Javascript">
        <!--
        document.location.replace("index.php?page=2");
        // -->
        </script>';
    }
}
?>

