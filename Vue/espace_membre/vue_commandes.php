
<br>
<h3>Liste des Commandes</h3>
<form method="post">
	<input type="text" name="mot">
	<input type="submit" name="rechercher_commande_en_cours" value="Rechercher">
</form>
<br>

<div class="table-box">
    <table border="3">
    <?php if(isset($_SESSION['roles']) && $_SESSION['roles']=='admin'){ ?>
        <tr>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Reference du panier</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Reference User </td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Statut de la commande</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Quantite d'article</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  HT</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  TTC</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Date  Commande</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Action</td>
        </tr>
        <?php
        foreach($les_commandes_en_cours as $une_commande_en_cours){
            echo"<form method='post'><tr>";
            echo"<td>".$une_commande_en_cours['idpanier']."</td>";
            echo"<td>".$une_commande_en_cours['iduser']."</td>";
            echo"<td>".$une_commande_en_cours['statut']."</td>";
            echo"<td>".$une_commande_en_cours["nbArticle"]."</td>";
            echo"<td>".$une_commande_en_cours["totalHT"]."</td>";
            echo"<td>".$une_commande_en_cours["totalTTC"]."</td>";
            echo"<td>".$une_commande_en_cours["datecommande"]."</td>";
            echo '<input type="hidden" name="idpanier" value="'.$une_commande_en_cours['idpanier'].'">';
            echo"<td><input type='submit' name='valider_commande' value='Valider'>
                        <input type='submit' name='annule_commande' value='Annuler'>
                        <input type='submit' name='archive_commande' value='Archiver'></td>";

            echo "<tr></form>";
        }
        ?>
    </table>
<br>
    <h3>historique des commandes</h3>

    <table border="3">
        <tr>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Reference commande</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Reference User </td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Statut de la commande</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Quantite d'article</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  HT</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  TTC</td>
            <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Date  Commande</td>
            
            
        </tr>

        <?php
        foreach($les_commandes_archives as $une_commande_archive){
            echo"<form method='post'><tr>";
            echo"<td>".$une_commande_archive['idpanier']."</td>";
            echo"<td>".$une_commande_archive['iduser']."</td>";
            echo"<td>".$une_commande_archive['statut']."</td>";
            echo"<td>".$une_commande_archive["nbArticle"]."</td>";
            echo"<td>".$une_commande_archive["totalHT"]."</td>";
            echo"<td>".$une_commande_archive["totalTTC"]."</td>";
            echo"<td>".$une_commande_archive["datecommande"]."</td>";
            echo '<input type="hidden" name="iduser" value="'.$une_commande_archive['idpanier'].'">';
            echo "<tr></form>";
        }

}else{ ?>
    <tr>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">References commandes</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Reference User </td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Statut commande</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Quantite d'article</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  HT</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  TTC</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Date  Commande</td>
</tr>
<?php
foreach($mes_commandes_en_cours as $mes_commande_en_cours){
    echo"<form method='post'><tr>";
    echo"<td>".$mes_commande_en_cours['idpanier']."</td>";
    echo"<td>".$mes_commande_en_cours['iduser']."</td>";
    echo"<td>".$mes_commande_en_cours['statut']."</td>";
    echo"<td>".$mes_commande_en_cours["nbArticle"]."</td>";
    echo"<td>".$mes_commande_en_cours["totalHT"]."</td>";
    echo"<td>".$mes_commande_en_cours["totalTTC"]."</td>";
    echo"<td>".$mes_commande_en_cours["datecommande"]."</td>";
    echo '<input type="hidden" name="idpanier" value="'.$mes_commande_en_cours['idpanier'].'">';
    echo "<tr></form>";
}
?>
</table>
<br>
<h3>historique des commandes</h3>

<table border="3">
<tr>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">References commandes</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Reference User </td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Statut de la commande</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Quantite d'article</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  HT</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Prix  TTC</td>
    <td style="background: #00bcd4; color: #fff; box-sizing: border-box;">Date  Commande</td>
    
    
</tr>

<?php
foreach($mes_commandes_archives as $mes_commande_archive){
    echo"<form method='post'><tr>";
    echo"<td>".$mes_commande_archive['idpanier']."</td>";
    echo"<td>".$mes_commande_archive['iduser']."</td>";
    echo"<td>".$mes_commande_archive['statut']."</td>";
    echo"<td>".$mes_commande_archive["nbArticle"]."</td>";
    echo"<td>".$mes_commande_archive["totalHT"]."</td>";
    echo"<td>".$mes_commande_archive["totalTTC"]."</td>";
    echo"<td>".$mes_commande_archive["datecommande"]."</td>";
    echo '<input type="hidden" name="iduser" value="'.$mes_commande_archive['idpanier'].'">';
    echo "<tr></form>";
}
}
        ?>
    </table>
    </div>
