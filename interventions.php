<?php


/***************************************VUE INTERVENTION******************************************/
$unControleur->setTable('users');
$les_users = $unControleur->selectAll();
$unControleur->setTable('technicien');
$lesTechniciens = $unControleur->selectAll();

if(isset($_SESSION) && $_SESSION['roles'] === 'technicien'){
	$unControleur->setTable('intervention');
	$intervention_technicien = $unControleur->intervention_technicien();
}else {
	$intervention_technicien = "";
}

$unControleur->setTable('vue_intervention_and_users_archive');
$les_interventions_archive = $unControleur->selectAll();
$mes_interventions_archive = $unControleur->select_mes_interventions ();

$unControleur->setTable('vue_intervention_and_users_enCours');
$one_intervention = null;
	if (isset($_POST['rechercher_intervention']))
	{
		$mot = $_POST['mot']; 
		$tab = array("idintervention", "libelle", "dateintervention","iduser", "nomClient", "nomTech", "statut");
		$les_interventions_enCours = $unControleur->selectLikeAll($mot, $tab); 
		$mes_interventions_enCours = $unControleur->select_like_mine_intervention($mot); 
		 require_once("Vue/espace_membre/vue_interventions.php");
	}else{
		$les_interventions_enCours = $unControleur->selectAll();
		$mes_interventions_enCours = $unControleur->select_mes_interventions ();
	}

	if (isset($_POST['ajouter_intervention'])){
		if (empty(trim($_POST['iduser'])) || empty(trim($_POST['libelle'])) || empty($_POST['dateintervention'])){
			echo "</br></br>Probleme à la saisie. Aucune intervention n'a été ajouté ";
		}else{
		$unControleur->setTable('intervention');
		$libelle = $_POST['libelle'];
		$prixHT = 0.0;
		switch ($libelle){
			case 'diagnostic': $prixHT = 39.59; break;
			case 'vidange': $prixHT = 59; break; 
			case 'controle' : $prixHT = 78; break;
			default: $prixHT= 0; 
		}
		$tab = array("libelle"=>htmlspecialchars($_POST['libelle']),"dateintervention"=>htmlspecialchars($_POST['dateintervention']), "statut"=>'En attente', "prixHT"=>$prixHT, "prixTTC"=>NULL, "iduser"=>$_POST['iduser'], "idtechnicien" =>$_POST['idtechnicien']);
		$unControleur->insert($tab); 
        header("Location: index.php?page=11");
		}
	}

	if (isset($_POST['delete_intervention']))
    {
		$unControleur->setTable('intervention');
        $idintervention = $_POST['idintervention']; 
        $unControleur->delete("idintervention", $idintervention);  
		echo "<br/>L'intervention : ".$idintervention." à été supprimé"; 
        header("Location: index.php?page=11");

    }

	if (isset($_POST['edit_intervention'])){
		$idintervention = $_POST['idintervention']; 
        $one_intervention = $unControleur->selectWhere('idintervention', $idintervention); 
		require_once("Vue/espace_membre/vue_interventions.php");
	}

	if (isset($_POST['modifier_intervention'])){
		if (empty(trim($_POST['iduser'])) || empty(trim($_POST['libelle'])) || empty($_POST['dateintervention'])){
			echo "</br></br>Probleme à la saisie. Aucune intervention n'a été modifié ";
		}else{
		$unControleur->setTable('intervention');
		$tab = array("iduser"=>htmlspecialchars($_POST['iduser']),"libelle"=>htmlspecialchars($_POST['libelle']),"dateintervention"=>htmlspecialchars($_POST['dateintervention']), "idtechnicien" =>$_POST['idtechnicien']);
		$unControleur->update($tab, "idintervention", $_POST['idintervention']);
		echo "<br/>L'intervention ".$_POST['idintervention']." à été modifié"; 
        header("Location: index.php?page=11");
		}
	}
 
	if (isset($_POST['annule_intervention'])){
		$idintervention = $_POST['idintervention']; 
		$unControleur->annule_intervention($idintervention);
		echo "<br/>Commande mis à jour !";
        header("Location: index.php?page=11");
	}

	if (isset($_POST['valider_intervention'])){
		$idintervention = $_POST['idintervention']; 
		$unControleur->valider_intervention($idintervention);
		echo "<br/>Intervention mis à jour !"; 	
        header("Location: index.php?page=11");

	}

	if (isset($_POST['archive_intervention'])){
		$idintervention = $_POST['idintervention']; 
		$unControleur->archive_intervention($idintervention);
		echo "<br/>Intervention mis à jour !"; 
        header("Location: index.php?page=11");

	}

	if (!isset($_SESSION['email'])){
		//require_once("vue/connexion_inscription.php");
		header("Location: index.php?page=6");
	}else{
	require_once("Vue/espace_membre/vue_interventions.php");
	}