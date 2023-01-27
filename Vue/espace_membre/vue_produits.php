<br><br>
<h3>PRODUIT EN STOCK</h3>
<br>

<div class="header_product">
        <form method="post">
        <input type="recherche" name="mot" placeholder="  Recherche...">
        <input type="submit" name='filtrer_produits' value="rechercher">
        </form>
    </div>

<table border="1" style="
    background: #fff;
    box-shadow: 0 10px 100px rgba(0, 0, 0, 0.5);
">
    <tr>
        <td></td>
        <td>ID Produits</td>
        <td>Nom produit</td> 
        <td>Quantite en stock</td> 
    </tr>

    <?php
        foreach($les_produits as $un_produit){
            echo"<form method='post'><tr>";
            echo"<td><img src='img/".$un_produit['nomProduit'].".jpeg'  style='width: 100px; height: 100px; margin-right: 10px;'></td>";
            echo"<td>".$un_produit['idProduit']."</td>";
            echo"<td>".$un_produit['nomProduit']."</td>";
            echo"<td>".$un_produit['quantite']."</td>";
            echo '<input type="hidden" name="idproduit" value="'.$un_produit['idProduit'].'">';
            echo"<td>
                    <select name='qteproduit' style='width: 175px;'>
                    <option value='0'>0</option>
                        <option value='10'>10</option>
                        <option value='50'>50</option>
                        <option value='100'>100</option>
                        <option value='500'>500</option>
                        <option value='1000'>1000</option>
                    </select>
                        <input type='submit' name='commander_produit' value='Commander'></td>";
            echo "<tr></form>";
        }
    ?>

</table>
