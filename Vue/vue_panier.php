<link rel="stylesheet" href="css/tab_commande.css">

<div class="small-container cart-page">
  <table> 
  
    <tr>
      <th></th>
      <th>Produit</th>
      <th>Quantité</th>
      <th>Prix HT</th>
      <th></th>
    </tr>
    <tr>
    <?php
        $idproduit = array_keys($_SESSION['panier']);
        if(empty($idproduit)){
          $produits = array();
        }else{
        //$produits = $unControleur->query('select * from produit where idproduit in ('.implode(',',$idproduit).')');
        $produits = $unControleur->selectAllProduit($idproduit); 
        }
        foreach($produits as $produit):
      ?>
      <td><a href="" class="img"><img src="img/<?= $produit->nomProduit; ?>.jpeg" style="width: 100px; height: 100px; margin-right: 10px;"></a></td>

        <td>
          <p><?= $produit->nomProduit ?></p>
        </td>

        <td>
        <div>
          <p><?= $_SESSION['panier'][$produit->idProduit]; ?></p>
        </div>
        </td>

      <td><?= number_format($produit->prixProduit,2,',',' '); ?>€</td>

      <td><a href="addpanier.php?del=<?=$produit->idProduit;?>"><img src="./img/sup.png" width="30px"></a></td>
    </tr>
    <?php endforeach;  ?> 

  </table>

  <div class="total-price">

  <table>
    <tr>
      <td>Nombre d'articles au panier</td>
      <td><?= $unControleur->nb_article_panier();?></td>
    </tr>

    <tr>
      <td>Prix total du panier HT</td>
      <td><?= number_format($unControleur->total(),2,',',' '); ?></td>
    </tr>

    <tr>
      <td>Prix total TTC du panier</td>
      <td><?= number_format($unControleur->total()*1.2,2,',',' '); ?></td>
    </tr>
  </table>

  </div>
</div>
<div>
  <?php
    if($unControleur->nb_article_panier() == 0 ){
      ?> 
      <a href="index.php?page=1">Visiter le catalogue</a>
      <?php
    }else{
      ?> 
      <form method='post'>
	    <input type="submit" name="valider_panier" value="Valider le panier">
      </form>
      <?php
    }
  ?>

</div>
<br>
