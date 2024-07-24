<?php

class utilisateur{
    // Connexion à la BDD
    private $connexion;
    private $table = "utilisateur"; // Table dans la base de données

    // Propriétés
    public $ID_Utilisateur;
    public $NOM;
    public $PRENOM;
    public $Login;
    public $Mot_de_passe;


    // Constructeur avec $db pour la connexion à la base de données

    public function __construct($db){
        $this->connexion = $db;
    }

//Lecture des utilisateur, fonction retourne un void

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
    $sql = "INSERT INTO " . $this->table . " SET NOM=:NOM, PRENOM=:PRENOM, Login=:Login, Mot_de_passe=:Mot_de_passe";

    // Préparation de la requête
    $query = $this->connexion->prepare($sql);

    // Protection contre les injections
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
        return true;
    }
    return false;
}
    // Supprimer un produit

    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE ID_Utilisateur= ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));

        // On attache l'id
        $query->bindParam(1, $this->ID_Utilisateur);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }
    // Mettre à jour un produit

    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET NOM = :NOM, PRENOM = :PRENOM, Login = :Login , Mot_de_passe = :Mot_de_passe WHERE ID_Utilisateur = :ID_Utilisateur";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->NOM=htmlspecialchars(strip_tags($this->NOM));
        $this->PRENOM=htmlspecialchars(strip_tags($this->PRENOM));
        $this->Login=htmlspecialchars(strip_tags($this->Login));
        $this->Mot_de_passe=htmlspecialchars(strip_tags($this->Mot_de_passe));
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));
        
        // On attache les variables
        $query->bindParam(':NOM', $this->NOM);
        $query->bindParam(':PRENOM', $this->PRENOM);
        $query->bindParam(':Login', $this->Login);
        $query->bindParam(':Mot_de_passe', $this->Mot_de_passe);
        $query->bindParam(':ID_Utilisateur', $this->ID_Utilisateur);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }
    public function settable(string $table){

        $this->table = $table;
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