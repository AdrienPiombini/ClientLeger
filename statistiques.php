

<?php
if (!isset($_SESSION['email'])){
		//require_once("vue/connexion_inscription.php");
        header("Location: index.php?page=6");
	}else if (isset($_SESSION['roles']) AND $_SESSION['roles']== 'admin'){
    require_once("vue/espace_membre/vue_statistiques.php");
    }else (require_once("erreur404.php"));

