<?php 
require_once('vue/vue_mdpOublie.php');
if(isset($_POST['mdpOublie'])){
		$unControleur->setTable('mdpOublie');
		$email = $_POST['email'];
		$iduser = $unControleur->selectWhere("email", $email); 
		if($iduser['question']==$_POST['question'] && $iduser['reponse']==$_POST['reponse']){
			$unControleur->updateMDP($_POST['mdp'], $_POST['email']);
			header("Location: index.php?page=2");
			echo "<script> alert('Veillez à changer votre mot de passe !'); </script>";
		}
		else{
			echo "<script> alert('Renseigner les valeurs exactes !'); </script>";
		}
	}
	?> 