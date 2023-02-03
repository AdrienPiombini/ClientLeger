<?php
/***************************************VUE GESTION COMPTE******************************************/

	//$unControleur->setTable("clientAll");
	if (isset($_SESSION['email'])){
		$emailuser = $_SESSION['email'];
	}else{
		$emailuser='';
	}
	if(isset($_SESSION['roles']) AND $_SESSION['roles']== 'admin'){
		$unControleur->setTable("admin");
		$one_user = $unControleur->selectWhere("email", $emailuser); 
		if (isset($_POST['modifier_user'])){
			if(empty(trim($_POST['email']))){
				echo "<br/></br>Renseigner un email !"; 
			}else{
			$tab = array("email"=>$_POST['email'],"nom"=>$_POST['nom'], "prenom"=>$_POST['prenom']);
			$unControleur->update($tab, "iduser", $_POST['iduser']);
			echo "<br/>L'utilisateur ".$_POST['email']." à été modifié"; 
			}
		}
	}elseif(isset($_SESSION['roles']) AND $_SESSION['roles']== 'technicien'){
		$unControleur->setTable("technicien");
		$one_user = $unControleur->selectWhere("email", $emailuser); 
		if (isset($_POST['modifier_user'])){
			if(empty(trim($_POST['email']))){
				echo "<br/></br>Renseigner un email !"; 
			}else{
			$tab = array("email"=>$_POST['email'],"nom"=>$_POST['nom'], "prenom"=>$_POST['prenom']);
			$unControleur->update($tab, "iduser", $_POST['iduser']);
			echo "<br/>L'utilisateur ".$_POST['email']." à été modifié"; 
			}
		}
	}elseif(isset($_SESSION['roles']) AND $_SESSION['roles']== 'client'){
			$unControleur->setTable("client");
			$one_user = $unControleur->selectWhere("email", $emailuser); 
		if ($one_user['typeclient']=='particulier'){
			$unControleur->setTable("particulier");
			$one_user = $unControleur->selectWhere("email", $emailuser); 
		if (isset($_POST['modifier_user'])){
			if(empty(trim($_POST['email']))){
				echo "<br/></br>Renseigner un email !"; 
		}
		else{
			$tab = array("email"=>$_POST['email'],"nom"=>$_POST['nom'],"adresse"=>$_POST['adresse'],"ville"=>$_POST['ville'], "cp"=>$_POST['cp'], "telephone"=>$_POST['telephone'], "prenom"=>$_POST['prenom']);
			$unControleur->update($tab, "iduser", $_POST['iduser']);
			echo "<br/>L'utilisateur ".$_POST['email']." à été modifié"; 
		}
	}
	}else{
	$unControleur->setTable("professionnel");
	$one_user = $unControleur->selectWhere("email", $emailuser); 
	if (isset($_POST['modifier_user'])){
		if(empty(trim($_POST['email']))){
			echo "<br/></br>Renseigner un email !"; 
		}else{
		$tab = array("email"=>$_POST['email'],"nom"=>$_POST['nom'],"adresse"=>$_POST['adresse'],"ville"=>$_POST['ville'], "cp"=>$_POST['cp'], "telephone"=>$_POST['telephone'], "numeroSiret"=>$_POST['siret']);
		$unControleur->update($tab, "iduser", $_POST['iduser']);
		echo "<br/>L'utilisateur ".$_POST['email']." à été modifié"; 
		}
	}
	}
}


	if (isset($_POST['edit_mdp'])){
		$unControleur->setTable("grainSel");
		$resultat = $unControleur->selectAll();
		$grain = $resultat[0]['salt'];
		$mdp = $_POST['old_mdp'].$grain;
		$mdp = sha1($mdp);
		$newMdp = $_POST['new_mdp'].$grain;
		$newMdp = sha1($newMdp);
		$mdpVerif = sha1($_POST['new_mdp_verif'].$grain);
		if ($newMdp!== $mdpVerif || $mdp !== $_SESSION['mdp']) {
			echo'<br/>Les informations renseignées ne sont pas correct';
		}else {
			$unControleur->setTable('users');
			$tab = array("mdp"=>htmlspecialchars($_POST['new_mdp']));
			$unControleur->updateMDP($_POST['new_mdp'], $_SESSION['email']);
			echo "<br/>Le mot de passe a bien été changé !"; 
		}
	}

	if (!isset($_SESSION['email'])){
		//require_once("vue/connexion_inscription.php");
        header("Location: index.php?page=6");
	}else{
    require_once("vue/espace_membre/vue_gestion_compte.php");
    }


