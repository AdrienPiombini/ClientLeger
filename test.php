

<?php

    echo '

<div class="sectionID  " id="">
    <div class="bloc-vue position-relative rounded-2" id="bloc_view">
    <button class="rounded-2 border-light m-1" id="exitBtn"> exit
    </button>
    <h5 class="text-white text-center pt-1">Details</h5>
 
        <div class=" container-fluid p-5">
        <table class="table  me-5 table-striped table-bordered "> 
        <thead>
            <tr class="text-center text-light tr_top">
            <tr>
              <th scope="col"> id</th>
              <th scope="col"> prix</th>
              <th scope="col">nom</th>
                </tr>
            </thead>


            <tbody>';
            foreach($les_commandes_archives as $une_commande_archive){
                echo"<form method='post'><tr>";
                echo"<td>".$une_commande_archive['idcommande']."</td>";
                echo"<td>".$une_commande_archive['iduser']."</td></tr>";

            }


    
    echo '
            </tbody>
        </table>

</div>
</div>
        </div>' ;

?>







<style>
    body .sectionID {
  display: flex;
  background-color: rgba(255, 255, 255, 0.8);
  top: 0;
  left: 0;
  right: 0;
  position: absolute;
  height: 100vh;
  width: 100%;
  justify-content: center;
  align-items: center;
}
body .sectionID .bloc-vue {
  width: 60%;
  background-color: #2b2f3d;
}
body .sectionID .bloc-vue .tr_top {
  border-radius: 0.2rem 0.2rem 0 0;
  background-color: #0E7AE6;
}

</style>

