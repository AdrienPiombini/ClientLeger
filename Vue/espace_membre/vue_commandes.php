<!-- <h1>Gestion des utilisateurs</h1> -->
<link rel="stylesheet" href="css/tableau.css">
<link rel="stylesheet" href="css/form_insert.css">

<br><br>

<br>
<h3>Liste des commandes</h3>
<form method="post">
	<input type="text" name="mot">
	<input type="submit" name="rechercher_commande" value="Rechercher">
</form>
<br>

<div class="table-box">
    <table border="1">
        <tr>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;"></td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Numero de commande</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Nom de la personne</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Nom du Produit</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Qunatite de produit</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Statut de la commande</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Action</td>

            
            
        </tr>

        <?php
        foreach($les_commandes as $une_commande){
            echo"<form method='post'><tr>";
            echo"<td><img src='img/user.png'></td>";
            echo"<td>".$une_commande['idpanier']."</td>";
            echo"<td>".$une_commande['iduser']."</td>";
            echo"<td>".$une_commande['idproduit']."</td>";
            echo"<td>".$une_commande['quantiteproduit']."</td>";
            echo"<td>".$une_commande['statut']."</td>";

            echo '<input type="hidden" name="iduser" value="'.$une_commande['iduser'].'">';
            echo"<td><input type='submit' name='' value='Annuler'>";
            echo "<tr></form>";

        }
        ?>
    </table>
    </div>

    