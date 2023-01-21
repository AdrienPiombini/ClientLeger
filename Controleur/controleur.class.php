<?php
require_once("Modele/modele.class.php");
class Controleur {
    /***********************CONNEXION A LA BASE DE DONNE **********************/
    private $unModele; // instance de la classe modele 
    public function __construct($serveur, $bdd, $user, $mdp)
    {
        $this->unModele = new Modele($serveur, $bdd, $user, $mdp);

    /***********************PANIER **********************/
        if(!isset($_SESSION)){
            session_start();
        }
        if(!isset($_SESSION['panier'])){
            $_SESSION['panier']= array();
        }
    /***********************PANIER **********************/
    }

    public function verif_connexion($email, $mdp){
        return $this->unModele->verif_connexion($email, $mdp);
    }


    /***********************CONNEXION A LA BASE DE DONNE **********************/

    public function select_mes_interventions(){
        $mes_interventions = $this->unModele->select_mes_interventions();
        return $mes_interventions;
    }



    public function select_like_mine_intervention($mot){
        $mes_interventions =  $this->unModele->select_like_mine_intervention($mot);
        return $mes_interventions;
    }


 /************************      MODELE GENERIQUE  ******************************************/

 public function setTable($uneTable){
    $this->unModele->setTable($uneTable);
}

public function selectAll(){
    $lesResultats = $this->unModele->selectAll();
    return $lesResultats;
}

public function insert($tab)
{
    $this->unModele->insert($tab);
}

public function selectLikeAll($mot, $tab){
    $lesResultats = $this->unModele->selectLikeAll($mot, $tab);
    return $lesResultats;
}

public function delete($id, $valeur){
    $this->unModele->delete($id, $valeur);
}

public function selectWhere($id, $valeur){
    return $this->unModele->selectWhere($id, $valeur);
}

public function update($tab, $id, $valeur){
    $this->unModele->update($tab, $id, $valeur);
}

public function count ($table){
    return $this->unModele->count($table);
}




 /************************ PANIER  *******************************************/ /************************ PANIER  *******************************************/
 /*
 public function query($sql, $data = array() ){
    return $this->unModele->query($sql, $data );
}
*/

public function nb_article_panier(){
    return array_sum($_SESSION['panier']);
}

public function ajouter_panier($idproduit){
    if(isset($_SESSION['panier'][$idproduit])){
    $_SESSION['panier'][$idproduit]++ ;
    }else{
    $_SESSION['panier'][$idproduit]= 1 ;
    }
}

public function del($idproduit){
    if(($_SESSION['panier'][$idproduit])>1){
        $_SESSION['panier'][$idproduit];
    }else{
        unset($_SESSION['panier'][$idproduit]);
    }
    
}

public function total(){
    $total =  $this->unModele->total();
    return $total;
}

public function verif_produit($valeur){
    return $this->unModele->verif_produit($valeur);
}

public function selectAllProduit($tab){
    $produits = $this->unModele->selectAllProduit($tab);
    return $produits;
}

public function idpanier(){
    $idpanier =  $this->unModele->idpanier();
    return $idpanier;
}

public function insert_panier($idpanier, $iduser, $idproduit, $quantiteproduit){
    $this->unModele->insert_panier($idpanier, $iduser, $idproduit, $quantiteproduit);
}

public function valider_commande($idpanier){
    $this->unModele->valider_commande($idpanier);
}

public function archive_commande($idpanier){
    $this->unModele->archive_commande($idpanier);
}

public function annule_commande($idpanier){
    $this->unModele->annule_commande($idpanier);
}


public function select_mine_commandes_en_cours(){
    $mes_commandes =  $this->unModele->select_mine_commandes_en_cours();
    return $mes_commandes;
 }

public function select_like_mine_commande($mot){
    $mes_commandes=  $this->unModele->select_like_mine_commande($mot);
    return $mes_commandes;
}



public function select_mine_commandes_archive(){
    $mes_commandes = $this->unModele->select_mine_commandes_archive();
    return $mes_commandes;
}

}
?>