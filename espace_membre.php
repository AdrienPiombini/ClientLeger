<?php
	if ( !isset($_SESSION['email'])){
		require_once("vue/connexion_inscription.php");
	}else{
		echo
		"<br><h1> Bienvenue " .$_SESSION['nom']. " sur votre espace membre</h1><br>";
		?>
		<div class="container">
		<form method="POST">
		<button class="btn-1" type="submit" name="deconnexion" value="deconnexion">Déconnexion</button>
		</form>
		<?php 
		if(isset($_POST['deconnexion'])){
			session_destroy();
			unset($_SESSION['email']);
			header("Location: index.php?page=2");
		}   

		echo'
		<br>
		<link rel="stylesheet" href="css/espace_membre.css">
		<form method="POST">
		<div class="all-button">
			<button class="btn-2" type="submit" name="gestion_compte" value="Gestion de compte">Paramètres</button>
			<button class="btn-2" type="submit" name="commandes" value="Commande">Commandes</button>
			<button class="btn-2" type="submit" name="interventions" value="Interventions">Interventions</button>';
			if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){
				echo'
					<button class="btn-2" type="submit" name="administration" value="Administration">Administration</button>
					<button class="btn-2" type="submit" name="statistiques" value="Statistiques">Statistiques</button><br>
				';}
		'</div></form></div>';
			
	}

/***************************************VERIFIE LES IDENTIFIANTS***************************************** */
	if(isset($_POST['signin'])){
		$email = htmlspecialchars($_POST['email']);
		$mdp = sha1(htmlspecialchars($_POST['mdp']));
		$unUser= $unControleur->verif_connexion ($email, $mdp);
			if($unUser == null){
				?><br> <center style="color: red; font-weight: bolder; position:absolute; bottom:150px; left:30%;"><?='Les informations renseigné ne permettre pas de vous authentifiez'; ?></center><?php
			}else{
				$_SESSION['email'] = $unUser['email'];
				$_SESSION['roles'] = $unUser['roles'];
				$_SESSION['mdp'] = $unUser['mdp'];
				$_SESSION['nom'] = $unUser['nom'];
				$_SESSION['iduser'] = $unUser['iduser'];
				echo '<script language="Javascript">
				<!--
				document.location.replace("index.php?page=2");
				// -->
				</script>';
				//header("Location: index.php?page=2");
			}


	}

	$unControleur->setTable('users');

	if(isset($_POST['inscription'])){
	
		if(!empty($_POST['email']) AND !empty($_POST['mdp'])){
			/*REGEX MDP ET EMAIL */
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) AND preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,})$/", $_POST['mdp'])){
				$tab = array("email"=>$_POST['email'],"mdp"=>sha1($_POST['mdp']),"nom"=>"","roles"=>"client");
				try{
					$une_inscription = $unControleur->insert($tab);
					echo '<script language="Javascript"><!-- document.location.replace("index.php?page=2");// --></script>';
					echo"Votre inscription à bien été enregistré";
				}
				catch( PDOException $erreur){
						echo'Une erreur est survenue';
				}					//header("Location: index.php?page=2") ;
			}else {
				echo'Renseigner des données valides !';
			}
		}
	}
/***************************************ESPACE ADMINISTRATION***************************************** */
	$one_user = null;
	$unControleur->setTable('users');
	if (isset($_POST['rechercher_user']))
	{
		$mot = $_POST['mot']; 
		$tab = array("iduser", "email", "roles");
		$les_users = $unControleur->selectLikeAll($mot, $tab); 
		require_once("vue/espace_membre/vue_administration.php");
	}else{
		$les_users = $unControleur->selectAll(); 
		}


	if (isset($_POST['ajouter_user']))
	{
		if(empty(trim($_POST['email'])) || empty(trim($_POST['mdp'])) || $_POST['roles']=='Choisir un rôles utilisateur'){
			echo "<br/></br>Problème rencontré à la saisie des données, aucun utilisateur n'a été ajouté"; 
		}else{
		$tab = array("email"=>$_POST['email'],"mdp"=>$_POST['mdp'], "nom"=>"","roles"=>$_POST['roles']);
		$unControleur->insert($tab); 
		echo "<br/>L'utilisateur : ".$_POST['email']." à été ajouté"; 
		}
	}

	if (isset($_POST['delete_user']))
    {
        $iduser = $_POST['iduser']; 
        $unControleur->delete("iduser", $iduser);  
		echo "<br/>L'utilisateur ".$iduser." à été supprimé"; 
    }

	
	if (isset($_POST['edit_user'])){
		$iduser = $_POST['iduser']; 
        $one_user = $unControleur->selectWhere("iduser", $iduser); 
		require_once("vue/espace_membre/vue_administration.php");
	}

	if (isset($_POST['modifier_user'])){
		if(empty(trim($_POST['email'])) || empty(trim($_POST['mdp'])) || $_POST['roles']=='Choisir un rôles utilisateur'){
			echo "<br/></br>Problème rencontré à la saisie des données, aucun utilisateur n'a été modifé"; 
		}else{
		$tab = array("email"=>$_POST['email'],"mdp"=>$_POST['mdp'],"roles"=>$_POST['roles']);
		$unControleur->update($tab, "iduser", $_POST['iduser']);
		echo "<br/>L'utilisateur ".$_POST['email']." à été modifié"; 
		}
	}


	
/***************************************VUE INTERVENTION******************************************/
$unControleur->setTable('vue_intervention_and_users');
$one_intervention = null;
	if (isset($_POST['rechercher_intervention']))
	{
		
		$mot = $_POST['mot']; 
		$tab = array("idintervention", "libelle", "dateintervention","iduser", "email");
		$les_interventions = $unControleur->selectLikeAll($mot, $tab); 
		$mes_interventions = $unControleur->select_like_mine_intervention($mot); 
		require_once("vue/espace_membre/vue_interventions.php");
	}else{

		$les_interventions = $unControleur->selectAll();
		//$les_interventions = $unControleur->select_all_interventions ();
		$mes_interventions = $unControleur->select_mes_interventions ();

	}

	if (isset($_POST['ajouter_intervention'])){
		if (empty(trim($_POST['iduser'])) || empty(trim($_POST['libelle'])) || empty($_POST['dateintervention'])){
			echo "</br></br>Probleme à la saisie. Aucune intervention n'a été ajouté ";
		}else{
		$unControleur->setTable('intervention');
		$tab = array("libelle"=>htmlspecialchars($_POST['libelle']),"dateintervention"=>htmlspecialchars($_POST['dateintervention']),"iduser"=>$_POST['iduser']);
		$unControleur->insert($tab); 
		echo "<br/>L'intervention à été ajouté  : ";
		}
	}

	if (isset($_POST['delete_intervention']))
    {
		$unControleur->setTable('intervention');
        $idintervention = $_POST['idintervention']; 
        $unControleur->delete("idintervention", $idintervention);  
		echo "<br/>L'intervention : ".$idintervention." à été supprimé"; 
    }


	if (isset($_POST['edit_intervention'])){
		$idintervention = $_POST['idintervention']; 
        $one_intervention = $unControleur->selectWhere('idintervention', $idintervention); 
		require_once("vue/espace_membre/vue_interventions.php");
	}

	if (isset($_POST['modifier_intervention'])){
		if (empty(trim($_POST['iduser'])) || empty(trim($_POST['libelle'])) || empty($_POST['dateintervention'])){
			echo "</br></br>Probleme à la saisie. Aucune intervention n'a été modifié ";
		}else{
		$unControleur->setTable('intervention');
		$tab = array("iduser"=>htmlspecialchars($_POST['iduser']),"libelle"=>htmlspecialchars($_POST['libelle']),"dateintervention"=>htmlspecialchars($_POST['dateintervention']));
		$unControleur->update($tab, "idintervention", $_POST['idintervention']);
		echo "<br/>L'intervention ".$_POST['idintervention']." à été modifié"; 
		}
	}
 

/***************************************VUE GESTION COMPTE******************************************/
	if (isset($_POST['edit_mdp'])){
		if (htmlspecialchars(sha1($_POST['new_mdp']))!==htmlspecialchars(sha1($_POST['new_mdp_verif'])) || sha1($_POST['old_mdp']) !== $_SESSION['mdp']) {
			echo'<br/>Les informations renseignées ne sont pas correct';
		}else {
			$unControleur->setTable('users');
			$tab = array("mdp"=>htmlspecialchars(sha1($_POST['new_mdp'])));
			$unControleur->update($tab, "iduser", $_SESSION['iduser']);
			echo "<br/>Le mot de passe a bien été changé !"; 
		}
		
	}

 /************************  VUE COMMANDES *******************************************/
 $unControleur->setTable('vue_commande_en_cours');
 
 if(isset($_SESSION['iduser'])){
	$iduser = $_SESSION['iduser'];
 }else {
	$iduser ='';
 }

 if (isset($_POST['rechercher_commande_en_cours']))
 {
	 $mot = $_POST['mot']; 
	 $tab = array("idpanier", "iduser", "nbArticle", "statut");
	 $les_commandes_en_cours = $unControleur->selectLikeAll($mot, $tab); 
	 $mes_commandes_en_cours = $unControleur->select_like_mine_commandes_en_cours($mot); 

	 require_once("vue/espace_membre/vue_commandes.php");
 }else{
	 $les_commandes_en_cours = $unControleur->selectAll(); 
	 $mes_commandes_en_cours = $unControleur->select_mine_commandes_en_cours($iduser); 

	 }

	 $unControleur->setTable('vue_commande_archive');
	$les_commandes_archives = $unControleur->selectAll(); 
	$mes_commandes_archives = $unControleur->select_mine_commandes_archive($iduser); 

		
if (isset($_POST['valider_commande'])){
	$idpanier = $_POST['idpanier']; 
	$unControleur->valider_commande($idpanier);
	echo "<br/>Commande mis à jour !"; 


}
if (isset($_POST['annule_commande'])){
	$idpanier = $_POST['idpanier']; 
	$unControleur->annule_commande($idpanier);
	echo "<br/>Commande mis à jour !"; 


}
if (isset($_POST['archive_commande'])){
	$idpanier = $_POST['idpanier']; 
	$unControleur->archive_commande($idpanier);
	echo "<br/>Commande mis à jour !"; 


}

		
 

/***************************************EN TETE******************************************/

	if(isset($_POST['gestion_compte'])){
		require_once("vue/espace_membre/vue_gestion_compte.php");
	}elseif(isset($_POST['commandes'])){
		require_once("vue/espace_membre/vue_commandes.php");
	}elseif(isset($_POST['interventions'])){
		require_once("vue/espace_membre/vue_interventions.php");
	}elseif(isset($_POST['administration'])){
		require_once("vue/espace_membre/vue_administration.php");
	}elseif(isset($_POST['statistiques'])){
		require_once("vue/espace_membre/vue_statistiques.php");
	}

	



	
	?>

