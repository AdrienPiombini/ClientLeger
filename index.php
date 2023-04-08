<?php 
//session_start();
require_once("Controleur/config_bdd.php");
require_once("Controleur/controleur.class.php");
$unControleur = new Controleur($serveur, $bdd, $user, $mdp);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
   
    <title>FILELEC</title>
</head>
<header class="header">
<a href="index.php?page=0"><img src="img/Filelect_logo.png" width=100px></a>
<nav>
    <ul class="nav">
        <li><a href="index.php?page=0">Accueil</a></li>
        <li><a href="index.php?page=1">Produits</a></li>
        <li><a href="index.php?page=5">A Propos</a></li>
        <?php
        if(!isset($_SESSION['email'])){
           echo' <li><a href="index.php?page=6">Espace membre</a></li>';      
        }else {
        echo'
        <div class="dropdown">
            <button class="bg-transparent btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="border:0; padding-top: 10px; color:black;">
            Espace Membre
            </button>
            <ul class="dropdown-menu dropdown-menu-warning">
                <li><a class="dropdown-item" href="index.php?page=11">Intervervention</a></li>
                <li><a class="dropdown-item" href="index.php?page=7">Commande</a></li>
                <li><a class="dropdown-item " href="index.php?page=9">Paramètres de compte</a></li>';
                if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){
                echo'<li><a class="dropdown-item " href="index.php?page=8">Produits</a></li>
                <li><a class="dropdown-item " href="index.php?page=10">Statistiques</a></li>';
                }
                }?>
            </ul>
        </div>

    </ul>
</nav>
<div class="icon">
<form method="POST">
<a href="index.php?page=3"><img src="img/panier.png" width="30px"></a>
<?php 
if(isset($_SESSION['email'])){
echo'
<button style="border:none;"><img src="img/deconnexion2.png" width="25px"></button>
<input type="hidden" name="deconnexion" value="deconnexion">
</form>';
		if(isset($_POST['deconnexion'])){
			session_destroy();
			unset($_SESSION['email']);
			header("Location: index.php?page=1");
		} 
 }
    ?>
</div>
</header>         
<body style="padding:0; margin:0; font-family: 'Sono', sans-serif; display: flex; flex-direction:column;min-height: 100vh;">
    <div>
        <center>
            <?php       
            if (isset($_GET['page'])){
                $page = $_GET['page'];
            }else{
                $page= 0;
            }
            switch ($page){
                case 0 : require_once("accueil.php"); break;
                case 1 : require_once("produit.php"); break;
                case 3  : require_once("panier.php"); break;
                case 4 : require_once("mdpOublie.php"); break; 
                case 5 : require_once("aPropos.php"); break; 
                case 6 : require_once("connexion_inscription.php"); break; 
                case 7 : require_once("commandes.php"); break; 
                case 8 : require_once("produits.php"); break; 
                case 9 : require_once("parametres.php"); break; 
                case 10 : require_once("statistiques.php"); break; 
                case 11 : require_once("interventions.php"); break; 
               default : require_once("erreur404.php"); break;
            }
            ?>
        </center>
    </div>

</body>
<?php 
require_once('Vue/footer.php');
?>
</html>


