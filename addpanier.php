<?php
session_start();
require_once("Controleur/config_bdd.php");
require_once("Controleur/controleur.class.php");
$unControleur = new Controleur($serveur, $bdd, $user, $mdp);

if (isset($_GET['id'])){
   $produits = $unControleur->verif_produit('idproduit', $_GET['id']);
    if(empty($produits)){
    die ("Ce produit n'existe pas");
    }
    $unControleur->ajouter_panier($produits[0]->idProduit);
    die('<center>Le produit à bien été ajouté au panier <a href="index.php?page=1">retourner le catalogue</a></ center>');
}elseif(isset($_GET['del'])){
    $unControleur->del($_GET['del']);
    die ("<center>Ce produit à été supprimé <a href='index.php?page=1'>retourner au catalogue</a></center>");
}
else{
    die ("Vous n'avez pas sélectionné de produit à ajouter au panier");
}

