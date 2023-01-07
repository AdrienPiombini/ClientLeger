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
<body style="padding:0; margin:0; font-family: 'Sono', sans-serif;">
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
               default : require_once("erreur404.php"); break;
            }
            ?>
        </center>
    </div>

    <footer>
        <hr>
        <div>
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27.68 0 1.36.09 2 .27 1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
            </svg></a>
            <a href=""><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z"/>
            </svg>
            </a>
        </div>
        <a href=""></a>

        <div><a href="">Legal Notice  </a></div>
        <div><a href="">© 2022 Filelec Entreprise • All Rights Reserved</a></div>
    </footer>
</body>

</html>


