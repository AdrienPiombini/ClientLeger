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

    public function setTable($uneTable){
        $this->table = $uneTable;
    }
	
    public function select_mes_interventions(){
        if($this->unPDO != null && isset($_SESSION['iduser']) != null){
            $requete = "select i.*, u.email from ".$this->table." i inner join users u on i.iduser = u.iduser where i.iduser = :iduser;";
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
            $requete = "select i.*, u.email from ".$this->table." i inner join users u on i.iduser=u.iduser where (libelle like :mot or dateintervention like :mot or email like :mot) and i.iduser = :iduser ;";
            $donnees = array(":mot"=>"%".$mot."%",":iduser"=>$_SESSION['iduser'] );
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $les_interventions = $select->fetchAll();
            return $les_interventions;
        }else{
            return null; 
        }
    }

	public function intervention_technicien (){
		if($this->unPDO != null && isset($_SESSION['email']) != null){
            $requete = "select i.* from ".$this->table." i inner join technicien t on i.idtechnicien = t.iduser inner join users u on t.email = u.email where u.iduser =:iduser;";
            $donnees =  array(":iduser"=>$_SESSION['iduser']); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $intervention_technicien = $select->fetchAll();
            return $intervention_technicien;
        }else{
            return null;
        }
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

		public function selectWhereAll($id, $valeur)
		{
			if($this->unPDO != null){
				$requete ="select * from ".$this->table." where ".$id." =:".$id.";";
				$donnees = array(":".$id=>$valeur);
			$select = $this->unPDO->prepare($requete);
			$select->execute($donnees);
			$unResultat = $select->fetchAll();
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


		public function verif_produit($valeur)
		{
			if($this->unPDO != null){
				$requete ="select idproduit from produit where idproduit =:".$valeur." and quantite > 0;";
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

	
		public function selectAllProduit($idproduit)
		{
			if($this->unPDO != null){
				
				$liste = implode ("," , $idproduit); 
				$donnees = "(".$liste.")";
				$requete ="select * from produit where idproduit  in  ".$donnees.";"; 
				$select = $this->unPDO->prepare($requete);
				$select->execute();
				$produits = $select->fetchAll(PDO::FETCH_OBJ);
				return $produits;
			}else{
				return null; 
			}
		}

		public function idpanier(){
			if($this->unPDO != null){
				$requete = "select max(idcommande) + 1 from ".$this->table.";";
				$select = $this->unPDO->prepare($requete);
				$select->execute();
				$lesResultats = $select->fetch();
				return $lesResultats;
			}
		}

		public function insert_panier($idpanier, $iduser, $idproduit, $quantiteproduit){
			if($this->unPDO != null){
				$requete ="call gestion_panier (".$idpanier.",".$iduser.",".$idproduit.",".$quantiteproduit.");"; 
				$select = $this->unPDO->prepare($requete);
				$select->execute();
		}
}

	public function valider_commande($idpanier){
		if($this->unPDO != null){
			$requete = "update commande set statut ='validée' where idcommande =:".$idpanier.";";
			$donnees = array(":".$idpanier=>$idpanier);
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
		}
	}

	public function archive_commande($idpanier){
		if($this->unPDO != null){
			$requete = "update commande set statut ='archivée' where idcommande =:".$idpanier.";";
			$donnees = array(":".$idpanier=>$idpanier);
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
		}
	}

	public function annule_commande($idpanier){
		if($this->unPDO != null){
			$requete = "update commande set statut ='annulée' where idcommande =:".$idpanier.";";
			$donnees = array(":".$idpanier=>$idpanier);
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
		}
	}


    public function select_mine_commandes_en_cours(){
        if($this->unPDO != null && isset($_SESSION['iduser']) != null){
            $requete = "select * from vue_commande_en_cours where iduser = :iduser;";
            $donnees =  array(":iduser"=>$_SESSION['iduser']); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $mes_commandes = $select->fetchAll();
            return $mes_commandes;
        }else{
            return null;
        }
    }

    public function select_like_mine_commande($mot){
        if($this->unPDO != null){
            $requete = "select * from vue_commande_en_cours where (idcommande like :mot or nbArticle like :mot or statut like :mot or datecommande like :mot or totalTTC like :mot or totalHT like :mot) and iduser = :iduser ;";
            $donnees = array(":mot"=>"%".$mot."%",":iduser"=>$_SESSION['iduser'] );
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $mes_commandes = $select->fetchAll();
            return $mes_commandes;
        }else{
            return null; 
        }
    }

	public function select_mine_commandes_archive(){
        if($this->unPDO != null && isset($_SESSION['iduser']) != null){
            $requete = "select * from vue_commande_archive where iduser = :iduser;";
            $donnees =  array(":iduser"=>$_SESSION['iduser']); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
            $mes_commandes = $select->fetchAll();
            return $mes_commandes;
        }else{
            return null;
        }
    }

	public function updateStock($qteCommande, $idproduit){
		if($this->unPDO != null){
			$requete = "update produit set quantite = quantite + :qteCommande where idProduit = :idproduit;";
            $donnees =  array("qteCommande"=>$qteCommande, ":idproduit"=>$idproduit); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
		}
	}



	/******************INTERVENTION********** */

	public function annule_intervention($idintervention){
		if($this->unPDO != null){
			$requete = "update intervention set statut ='Annulée' where idintervention =:".$idintervention.";";
			$donnees = array(":".$idintervention=>$idintervention);
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
		}
	}
	
	public function valider_intervention($idintervention){
		if($this->unPDO != null){
			$requete = "update intervention set statut ='Validée' where idintervention =:".$idintervention.";";
			$donnees = array(":".$idintervention=>$idintervention);
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
		}
	}

	public function archive_intervention($idintervention){
		if($this->unPDO != null){
			$requete = "update intervention set statut ='Archivée' where idintervention =:".$idintervention.";";
			$donnees = array(":".$idintervention=>$idintervention);
			$update = $this->unPDO->prepare($requete);
			$update->execute($donnees);
		}
	}

	
	public function updateMDP($mdp, $email){
		if($this->unPDO != null){
			$requete = "update particulier set mdp = :mdp where email = :email;";
			$donnees =  array("mdp"=>$mdp, ":email"=>$email); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
			$requete = "update professionnel set mdp = :mdp where email = :email;";
			$donnees =  array("mdp"=>$mdp, ":email"=>$email); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
			$requete = "update admin set mdp = :mdp where email = :email;";
			$donnees =  array("mdp"=>$mdp, ":email"=>$email); 
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
			$requete = "update technicien set mdp = :mdp where email = :email;";
			$donnees =  array("mdp"=>$mdp, ":email"=>$email);  
            $select = $this->unPDO->prepare($requete);
            $select->execute($donnees);
		}
	}

}


?>