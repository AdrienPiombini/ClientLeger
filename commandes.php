<?php


 /************************  VUE COMMANDES *******************************************/

 
 if(isset($_SESSION['iduser'])){
	$iduser = $_SESSION['iduser'];
 }else {
	$iduser ='';
 }
 $unControleur->setTable('vue_commande_archive');
 $les_commandes_archives = $unControleur->selectAll(); 
 $mes_commandes_archives = $unControleur->select_mine_commandes_archive($iduser); 

 $unControleur->setTable('vue_commande_en_cours');
 if (isset($_POST['rechercher_commande_en_cours']))
 {
	 $mot = $_POST['mot']; 
	 $tab = array("idcommande", "iduser", "nbArticle", "statut");
	 $les_commandes_en_cours = $unControleur->selectLikeAll($mot, $tab); 
	 $mes_commandes_en_cours = $unControleur->select_like_mine_commande($mot); 
	 require_once("vue/espace_membre/vue_commandes.php");
 }else{
	 $les_commandes_en_cours = $unControleur->selectAll(); 
	 $mes_commandes_en_cours = $unControleur->select_mine_commandes_en_cours($iduser); 
	
 }
		
if (isset($_POST['valider_commande'])){
	$idpanier = $_POST['idpanier']; 
	$unControleur->valider_commande($idpanier);
	echo "<br/>Commande mis à jour !"; 
    header("Location: index.php?page=7");


}
if (isset($_POST['annule_commande'])){
	$idpanier = $_POST['idpanier']; 
	$unControleur->annule_commande($idpanier);
	echo "<br/>Commande mis à jour !"; 
    header("Location: index.php?page=7");


}
if (isset($_POST['archive_commande'])){
	$idpanier = $_POST['idpanier']; 
	$unControleur->archive_commande($idpanier);
	echo "<br/>Commande mis à jour !"; 
    header("Location: index.php?page=7");
}

if(isset($_POST['details'])){
	$unControleur->setTable('details_commande');
	$idcommande = $_POST['idpanier'];
	$uneCommande = $unControleur->selectWhereAll('idcommande', 3); 
}else {
	$unControleur->setTable('details_commande');
}


	if (!isset($_SESSION['email'])){
		//require_once("vue/connexion_inscription.php");
        header("Location: index.php?page=6");
	}else{
    require_once("vue/espace_membre/vue_commandes.php");
    }
