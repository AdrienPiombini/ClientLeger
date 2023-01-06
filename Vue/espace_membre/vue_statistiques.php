<br><br>
<h3>STATISTIQUES DE L'ENTREPRISE</h3>
<br>

<table border="1" style="
    background: #fff;
    box-shadow: 0 10px 100px rgba(0, 0, 0, 0.5);
">
    <tr>
        <td>Nombre total d'intervention</td>
        <td>Nombre total d'utilisateur</td> 
    </tr>
    <tr>
        <td><?=$unControleur->count("intervention")['nb'];?></td>
        <td><?=$unControleur->count("users")['nb'];?></td>

    </tr>

</table>
