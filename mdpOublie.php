<?php 
require_once('vue/vue_mdpOublie.php');
if(isset($_POST['mdpOublie'])){
		$unControleur->setTable('mdpOublie');
		$email = $_POST['email'];
		try{
			$iduser = $unControleur->selectWhere("email", $email); 
			if($iduser['question']==$_POST['question'] && $iduser['reponse']==$_POST['reponse']){
				$unControleur->updateMDP($_POST['mdp'], $_POST['email']);
				header("Location: index.php?page=2");
				echo "<script> alert('Mot de passe réinitialisé !'); </script>";
			}
		}
		catch (PDOException ){
			echo "<script> alert('Renseigner des valeurs exactes !'); </script>";
		}
	}
	?> 