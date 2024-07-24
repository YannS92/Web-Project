<?php


class Etudiants {

    private $tableUtilisateur = "utilisateur"; // Table dans la base de données
    private $table = "etudiants";

    // Propriétés
    public $centre_etudiant;
    public $promotion_etudiant;
    public $ID_Utilisateur__CREE;




   // Constructeur avec $db pour la connexion à la base de données

   public function __construct($db){
    $this->connexion = $db;

   }
   //fonction pour lire un administrateur
   public function lire(){
    //  requête en sql 
    $sql = "SELECT*  FROM " . $this->table;

    // On prépare la requête
    $query = $this->connexion->prepare($sql);

    // On exécute la requête
    $query->execute();

    // On retourne le résultat
    return $query;
    }
    
    // Créer un utilisateur
    public function creer(){

        // Ecriture de la requête SQL en y insérant le nom de la table
        $sql = "INSERT INTO " . $this->tableUtilisateur . " SET NOM=:NOM, PRENOM=:PRENOM, Login=:Login, Mot_de_passe=:Mot_de_passe";
        $sql1 = "INSERT INTO etudiants (ID_Utilisateur,centre_etudiant,promotion_etudiant,NOM,PRENOM,Login,Mot_de_passe,ID_Utilisateur__CREE) SELECT ID_Utilisateur,'".$this->centre_etudiant."', '".$this->promotion_etudiant."',NOM,PRENOM,Login,Mot_de_passe,'".$this->ID_Utilisateur__CREE."' FROM ".$this->tableUtilisateur." WHERE NOM = '".$this->NOM."' && PRENOM = '".$this->PRENOM."' && Login='".$this->Login."' && Mot_de_passe = '".$this->Mot_de_passe."'";
        
        // Préparation de la requête
        $query = $this->connexion->prepare($sql);
        $query1 = $this->connexion->prepare($sql1);
        

        // Protection contre les injections
        $this->centre_etudiant=htmlspecialchars(strip_tags($this->centre_etudiant));
        $this->promotion_etudiant=htmlspecialchars(strip_tags($this->promotion_etudiant));
        $this->NOM=htmlspecialchars(strip_tags($this->NOM));
        $this->PRENOM=htmlspecialchars(strip_tags($this->PRENOM));
        $this->Login=htmlspecialchars(strip_tags($this->Login));
        $this->Mot_de_passe=htmlspecialchars(strip_tags($this->Mot_de_passe));

        // Ajout des données protégées
        $query->bindParam(":NOM", $this->NOM);
        $query->bindParam(":PRENOM", $this->PRENOM);
        $query->bindParam(":Login", $this->Login);
        $query->bindParam(":Mot_de_passe", $this->Mot_de_passe);


        // Exécution de la requête
        if($query->execute()){
        }
        
        // Exécution de la requête
        if($query1->execute()){
            return true;
        }
        return false;
        
    }
    // Supprimer un produit

    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE ID_Utilisateur= ?";
        $sql1 = "DELETE FROM " . $this->tableUtilisateur . " WHERE ID_Utilisateur= '".$this->ID_Utilisateur."'";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );
        $query1 = $this->connexion->prepare( $sql1 );

        // On sécurise les données
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));

        // On attache l'id
        $query->bindParam(1, $this->ID_Utilisateur);

        // On exécute la requête
        if($query->execute()){

        }

        if($query1->execute()){
            return true;
        }
        
        return false;
        
        
    }

    // Mettre à jour un produit

    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE ".$this->table."  SET centre_etudiant= '".$this->centre_etudiant."', promotion_etudiant= '".$this->promotion_etudiant."', NOM = '".$this->NOM."', PRENOM = '".$this->PRENOM."', Login = '".$this->Login."' , Mot_de_passe = '".$this->Mot_de_passe."', Id_Utilisateur__CREE='".$this->ID_Utilisateur__CREE."' WHERE ID_Utilisateur = '".$this->ID_Utilisateur."'";
        $sql1 = "UPDATE ".$this->tableUtilisateur." SET NOM = :NOM, PRENOM = :PRENOM, Login = :Login , Mot_de_passe = :Mot_de_passe WHERE ID_Utilisateur = :ID_Utilisateur";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        $query1 = $this->connexion->prepare($sql1);
        
        // Protection contre les injections
        $this->centre_etudiant=htmlspecialchars(strip_tags($this->centre_etudiant));
        $this->promotion_etudiant=htmlspecialchars(strip_tags($this->promotion_etudiant));
        $this->NOM=htmlspecialchars(strip_tags($this->NOM));
        $this->PRENOM=htmlspecialchars(strip_tags($this->PRENOM));
        $this->Login=htmlspecialchars(strip_tags($this->Login));
        $this->Mot_de_passe=htmlspecialchars(strip_tags($this->Mot_de_passe));
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));
        $this->ID_Utilisateur__CREE=htmlspecialchars(strip_tags($this->ID_Utilisateur__CREE));

        // Ajout des données protégées pour requête 1
        $query1->bindParam(":NOM", $this->NOM);
        $query1->bindParam(":PRENOM", $this->PRENOM);
        $query1->bindParam(":Login", $this->Login);
        $query1->bindParam(":Mot_de_passe", $this->Mot_de_passe);
        $query1->bindParam(':ID_Utilisateur', $this->ID_Utilisateur);

        
        
        
        // On exécute
        if($query->execute()){
        }
    
        // On exécute
        if($query1->execute()){
            return true;
        }
        
        return false;
    }
    public function Doublons(){
        //  requête en sql 
        $sql = "SELECT * FROM  " . $this->table . " WHERE Login= '".$this->Login."'";
    
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
    
        // On exécute la requête
        $query->execute();
    
        // On retourne le résultat
        return $query;
    }

}


?>