<?php 
if(isset($_SESSION['email'])){
    header("Location: index.php?page=1");
}else{
    require_once("Vue/vue_connexion_inscription.php");
}
if(isset($_POST['signin'])){
    $email = htmlspecialchars($_POST['email']);
    $mdp = htmlspecialchars($_POST['mdp']);
    $unControleur->setTable("grainSel");
    $resultat = $unControleur->selectAll();
    $grain = $resultat[0]['salt'];
    $mdp = $mdp.$grain;
    $mdp = sha1($mdp);
    $unUser= $unControleur->verif_connexion ($email, $mdp);
        if($unUser == null){
            echo "<script> alert('Les données renseignées ne sont pas valide !'); </script>";
        }else{
            $today = date ("Y-m-d");
            $dtmdp = $unUser['datemdp'];
            $debut = new DateTime ($today);
            $fin = new DateTime ($dtmdp);
            $interval = $debut->diff($fin);
            $_SESSION['email'] = $unUser['email'];
            $_SESSION['roles'] = $unUser['roles'];
            $_SESSION['mdp'] = $unUser['mdp'];
            $_SESSION['nom'] = $unUser['nom'];
            $_SESSION['iduser'] = $unUser['iduser'];

            if ($interval->format("%a") < 20 ){
                echo '<script language="Javascript">
                <!--
                document.location.replace("index.php?page=1");
                // -->
                </script>';
            }else{
                echo "<script> alert('Veillez à changer votre mot de passe !'); </script>";
                echo '<script language="Javascript">
                <!--
                document.location.replace("index.php?page=1");
                // -->
                </script>';			
            }			
        }
}

	if(isset($_POST['inscription'])){
		if(!empty($_POST['email']) AND !empty($_POST['mdp'])){
			/*REGEX MDP ET EMAIL */
			if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) AND preg_match("/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{8,})$/", $_POST['mdp'])){
				if($_POST['type'] == 'professionnel'){
					$unControleur->setTable('professionnel');
					$tab = array("email"=>$_POST['email'],"mdp"=>$_POST['mdp'],"nom"=>$_POST['nom'],"roles"=>"client","datemdp"=>date("Y-m-d"), "typeclient"=>$_POST['type'], "adresse"=>$_POST['adresse'],"ville"=>$_POST['ville'], "cp"=>$_POST['codepostal'], "telephone"=>$_POST['telephone'],  "numeroSiret"=>0);
				}elseif ($_POST['type'] == 'particulier') {
					$unControleur->setTable('particulier');	
					$tab = array("email"=>$_POST['email'],"mdp"=>$_POST['mdp'],"nom"=>$_POST['nom'],"roles"=>"client","datemdp"=>date("Y-m-d"), "typeclient"=>$_POST['type'], "adresse"=>$_POST['adresse'],"ville"=>$_POST['ville'], "cp"=>$_POST['codepostal'], "telephone"=>$_POST['telephone'],  "prenom"=>"");
				}
					try{
						$unControleur->insert($tab); //$une_inscription =
						$unControleur->setTable('mdpOublie');
						$tab = array("question"=>$_POST['question'], "reponse"=>$_POST['reponse'], "email"=>$_POST['email']);
						$unControleur->insert($tab);
						echo"Votre inscription à bien été enregistré";											
					}
					catch( PDOException $erreur){
							echo"Une erreur est survenue".$erreur;
					}	
			}else {
				echo'Renseigner des données valides !';
			}
	    }
	}
?>