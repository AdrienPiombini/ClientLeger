<?php 
require_once('Vue/vue_mdpOublie.php');
if(isset($_POST['mdpOublie'])){
		$unControleur->setTable('mdpOublie');
		$email = $_POST['email'];
		try{
			$iduser = $unControleur->selectWhere("email", $email); 
			if($iduser['question']==$_POST['question'] && $iduser['reponse']==$_POST['reponse']){
				$unControleur->updateMDP($_POST['mdp'], $_POST['email']);
				echo "<script> alert('Mot de passe réinitialisé !'); </script>";
				echo '<script language="Javascript">
                <!--
                document.location.replace("index.php?page=6");
                // -->
                </script>';
			}else{
				echo "<script> alert('Les valeurs renseigné ne sont pas correcte !'); </script>";
			}
		}
		catch (PDOException ){
			echo "<script> alert('Renseigner des valeurs exactes !'); </script>";
		}
	}
	?> 