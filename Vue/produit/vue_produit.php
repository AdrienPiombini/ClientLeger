<link rel="stylesheet" href="css/produit.css">    
<div class="container_product">
    <div class="header_product">
        <form method="post">
        <input type="recherche" name="mot" placeholder="  Recherche...">
        <input type="submit" name='filtrer_produit' value="rechercher">
        </form>
    </div>
<div class="grille">
<?php foreach($produits as $produit): ?>
    <div class="grid-items">
    <div class="products">
        <div class="product">
            <div class="image">
                <img src="img/<?= $produit['nomProduit']; ?>.jpeg" alt="idproduit">
            </div>
            <div class="namePrice">
                <h3><?= $produit['nomProduit'];?></h3>
                <span><?= $produit['prixProduit'];?>€</span>
            </div>
            <p><?= $produit['description'];?></p>
            <div class="bay">
            <button><a  class='add addpanier' href="addpanier.php?id=<?= $produit['idProduit']; ?>">Ajouter au panier</a></button>
            </div>
        </div>
    </div>
</div>
<?php endforeach ?>
</div>
</div>


