<?php


class Modele { 
    /************************CONNEXION A LA BDD******************* */
    private $unPDO; // instance de la classe pdo PHP data Object
    public function __construct($serveur, $bdd, $user, $mdp){
        $this->unPDO = null ;   
    try {
        $url = "mysql:host=".$serveur.";dbname=".$bdd;
        $this->unPDO = new PDO($url, $user, $mdp);
    }catch (PDOException $exp){
        echo "</br> Erreur de connexion à la base de donnée !";
		echo $exp->getMessage();
    }
    }
    


    public function verif_connexion($email, $mdp){
        if($this->unPDO !=null){
            $requete = "select * from users where email =:email and mdp =:mdp;";
            $donnees= array(":email"=>htmlspecialchars($email),":mdp"=>htmlspecialchars($mdp));
            $select =$this->unPDO->prepare($requete);
            $select->execute($donnees);
            $unUser = $select->fetch();
            return $unUser;
        }else{
            return null;
        }
    }

    /******************************************************************************** */


    public function select_mes_interventions(){
        if($this->unPDO != null && isset($_SESSION['iduser']) != null){
            $requete = "select i.*, u.email from intervention i inner join users u on i.iduser = u.iduser where i.iduser = :iduser;";
            $donnees =  array(":iduser"=>$_SESSION['iduser']); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $mes_interventions = $select->fetchAll();
            return $mes_interventions;
        }else{
            return null;
        }
    }

    public function select_like_mine_intervention($mot){
        if($this->unPDO != null){
            $requete = "select i.*, u.email from intervention i inner join users u on i.iduser=u.iduser where (libelle like :mot or dateintervention like :mot or email like :mot) and i.iduser = :iduser ;";
            $donnees = array(":mot"=>"%".$mot."%",":iduser"=>$_SESSION['iduser'] );
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $les_interventions = $select->fetchAll();
            return $les_interventions;
        }else{
            return null; 
        }
    }



    public function setTable($uneTable){
        $this->table = $uneTable;
    }

    public function selectAll ()
		{
			if($this->unPDO != null){
				$requete = "select * from ".$this->table.";";
				$select = $this->unPDO->prepare($requete);
				$select->execute();
				$lesResultats = $select->fetchAll();
				return $lesResultats;
			}else{
				return null; 
			}
		}

    public function insert($tab)
		{
			if($this->unPDO != null){

				$tabChamps = array();
				$donnees = array();
				foreach($tab as $cle => $valeur){
					$tabChamps[]= ":".$cle;
					$donnees [":".$cle] = $valeur;
				}
				$chaineChamps = implode(",", $tabChamps);
				$requete ="insert into ".$this->table." values (null, ".$chaineChamps.");";
			$insert = $this->unPDO->prepare($requete);
			$insert->execute($donnees);
			}
		}

    public function selectLikeAll($mot, $tab){
			if($this->unPDO != null){
				$tabChamps = array();
				foreach($tab as $cle){
					$tabChamp[]=$cle." like :mot";
				}
				$chaineChamps = implode(" or ", $tabChamp);
				$requete = "select * from ".$this->table." where ".$chaineChamps.";";
				$donnees = array(":mot"=>"%".$mot."%");
				$select = $this->unPDO->prepare($requete);
				$select->execute($donnees);
				$lesResultats = $select->fetchAll();
				return $lesResultats;
			}else{
				return null; 
			}
		}


	public function delete($id, $valeur)
		{
			if($this->unPDO != null){
				$requete ="delete from ".$this->table." where ".$id." =:".$id.";";
				$donnees = array(":".$id=>$valeur);
			$delete = $this->unPDO->prepare($requete);
			$delete->execute($donnees);
			}
		}


		
	public function selectWhere($id, $valeur)
		{
			if($this->unPDO != null){
				$requete ="select * from ".$this->table." where ".$id." =:".$id.";";
				$donnees = array(":".$id=>$valeur);
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
			$unResultat = $select->fetch();
			return $unResultat;
			}
		}


	public function update($tab, $id, $valeurId)
		{
			if($this->unPDO != null){
				$tabChamps = array();
				$donnees = array();
				foreach($tab as $cle=>$valeur){
					$tabChamps[]=$cle." =:".$cle;
					$donnees[":".$cle]=$valeur;
				}
				$chaineChamps = implode(" , ", $tabChamps);
				$requete ="update ".$this->table." set ".$chaineChamps." where ".$id."=:".$id.";";
				 
				$donnees [":".$id] = $valeurId;	
				 
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
			}
		}

		public function count ($table){
			if($this->unPDO !=null){
				$requete = "select count(*) as nb from ".$table;
				$select = $this->unPDO->prepare($requete);
				$select->execute();
				$unResultat = $select->fetch();
				return $unResultat;
			}else{
				return null;
			}
		}
    /*************************************PANIER******************************************* */
             /************************ COMMANDES *******************************************/
     
  /*
        public function query($sql, $data){
            $req = $this->unPDO->prepare($sql);
            $req->execute($data);
            return $req->fetchAll(PDO::FETCH_OBJ);
        }
*/


		public function verif_produit($id, $valeur)
		{
			if($this->unPDO != null){
				$requete ="select idproduit from produit where ".$id." =:".$valeur.";";
				$donnees = array(":".$valeur=>$valeur);
				$select = $this->unPDO->prepare($requete);
				$select->execute($donnees);
				$unResultat = $select->fetchAll(PDO::FETCH_OBJ);
				return $unResultat;
			}
		}

		public function total(){
			$total = 0;
			$idproduit = array_keys($_SESSION['panier']);
			if(empty($idproduit)){
			  $produits = array();
			}else{
			$requete = 'select idProduit, prixProduit from produit where idproduit in ('.implode(',',$idproduit).')';
			$select = $this->unPDO->prepare($requete);
			$select->execute();
			$produits = $select->fetchAll(PDO::FETCH_OBJ);
			}
			foreach($produits as $produit){
				$total += $produit->prixProduit * $_SESSION['panier'][$produit->idProduit];
			}
			return $total;
		}

	
		public function selectAllProduit($tab)
		{
			if($this->unPDO != null){
				//$requete ="select * from produit where idproduit in  (:".$tab.");";
				//$donnees = (":".$tab=>implode(',',$tab));
				//$select->execute($donnees);
				$requete = "select * from produit where idproduit in (".implode(',',$tab).");";
				$select = $this->unPDO->prepare($requete);
				$select->execute();
				$produits = $select->fetchAll(PDO::FETCH_OBJ);
				return $produits;
			}else{
				return null; 
			}
		}


}




?>