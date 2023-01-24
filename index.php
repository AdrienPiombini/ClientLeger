<?php 
session_start();
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
   
    <title>FILELEC</title>
</head>
<header class="header">
<a href="index.php?page=0"><img src="img/Filelect_logo.png" width=100px></a>
<nav>
    <ul class="nav">
        <li><a href="index.php?page=0">Accueil</a></li>
        <li><a href="index.php?page=1">Produits</a></li>
    </ul>
</nav>
<div class="icon">
<a href="index.php?page=3"><img src="img/panier.png" width="30px"></a>
<a href="index.php?page=2"><img src="img/compte.png" width="30px"></a>
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
                case 2 : require_once("espace_membre.php"); break;
                case 3  : require_once("panier.php"); break;
                case 4 : require_once("mdpOublie.php"); break; 
               default : require_once("erreur404.php"); break;
            }
            ?>
        </center>
    </div>
<?php 
require_once('Vue/footer.php');
?>
</body>

</html>



