<br><br>
<h3>STATISTIQUES DE L'ENTREPRISE</h3>
<br>
<H3> LES UTILISATEURS </H3>
<table 
 class="table table-striped"
border="1" style="
    background: #fff;
    box-shadow: 0 10px 100px rgba(0, 0, 0, 0.5);
">
    <tr>
        <td>Nombre total d'utilisateurs</td>   
        <td>Nombre total de techniciens</td>     
        <td>Nombre total de clients</td>     
        <td>Nombre total de professionnels</td> 
        <td>Nombre total de particuliers</td>     

    </tr>
    <tr>
        <td><?=$unControleur->count("users")['nb'];?></td>
        <td><?=$unControleur->count("technicien")['nb'];?></td>
        <td><?=$unControleur->count("client")['nb'];?></td>
        <td><?=$unControleur->count("professionnel")['nb'];?></td>
        <td><?=$unControleur->count("particulier")['nb'];?></td>
    </tr>
</table>
<br><br>
<H3> LES INTERVENTIONS </H3>
<table 
class="table table-striped"
border="1" style="
    background: #fff;
    box-shadow: 0 10px 100px rgba(0, 0, 0, 0.5);
">
    <tr>
        <td>Nombre total d'intervention total</td>   
        <td>Nombre total d'intervention archivée</td>      
        <td>Nombre total d'intervention annulée</td>   
        <td>Nombre total d'intervention validée</td>     
        <td>Nombre total d'intervention en attente</td>      
    </tr>
    <tr>
        <td><?=$unControleur->count("intervention")['nb'];?></td>
        <td><?=$unControleur->count("vue_intervention_archive")['nb'];?></td>
        <td><?=$unControleur->count("vue_intervention_annulee")['nb'];?></td>
        <td><?=$unControleur->count("vue_intervention_validee")['nb'];?></td>
        <td><?=$unControleur->count("vue_intervention_enAttente")['nb'];?></td>

    </tr>
</table>

<br><br>
<H3> LES COMMANDES </H3>
<table
class="table table-striped"
border="1" style="
    background: #fff;
    box-shadow: 0 10px 100px rgba(0, 0, 0, 0.5);
">
    <tr>
        <td>Nombre total de commande total</td>   
        <td>Nombre total de commande archivée</td>      
        <td>Nombre total de commande annulée</td>   
        <td>Nombre total de commande validée</td>     
        <td>Nombre total de commande en cours</td>      
    </tr>
    <tr>
        <td><?=$unControleur->count("intervention")['nb'];?></td>
        <td><?=$unControleur->count("vue_commande_archivee")['nb'];?></td>
        <td><?=$unControleur->count("vue_commande_annulee")['nb'];?></td>
        <td><?=$unControleur->count("vue_commande_validee")['nb'];?></td>
        <td><?=$unControleur->count("vue_commande_enCours")['nb'];?></td>

    </tr>
</table>