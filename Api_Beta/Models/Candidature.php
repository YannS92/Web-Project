<?php

class Candidature{
    // Connexion à la BDD
    private $connexion;
    private $table = "candidature"; // Table dans la base de données

    // Propriétés
    public $ID_candidature;
    public $Cv_etudiant;
    public $lettre_de_motivation_etudiant;
    public $Fiche_de_validation;
    public $Convention_de_stage;
    public $LIEN_OFFRE;
    public $ID_Offre;
    public $ID_Utilisateur;
    public $ID_Utilisateur_Pilote;



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

// Créer une candidature
public function creer(){

    // Ecriture de la requête SQL en y insérant le nom de la table
    $sql = "INSERT INTO " . $this->table . 
    " SET  Cv_etudiant = :Cv_etudiant, lettre_de_motivation_etudiant = 
    :lettre_de_motivation_etudiant, Fiche_de_validation = 
    :Fiche_de_validation, Convention_de_stage = 
    :Convention_de_stage, LIEN_OFFRE = 
    :LIEN_OFFRE, ID_Utilisateur = 
    :ID_Utilisateur, ID_Offre = 
    :ID_Offre, ID_Utilisateur_Pilote = 
    :ID_Utilisateur_Pilote";

    // Préparation de la requête
    $query = $this->connexion->prepare($sql);


    // Protection contre les injections
    $this->Cv_etudiant=htmlspecialchars(strip_tags($this->Cv_etudiant));
    $this->lettre_de_motivation_etudiant=htmlspecialchars(strip_tags($this->lettre_de_motivation_etudiant));
    $this->Fiche_de_validation=htmlspecialchars(strip_tags($this->Fiche_de_validation));
    $this->Convention_de_stage=htmlspecialchars(strip_tags($this->Convention_de_stage));
    $this->LIEN_OFFRE=htmlspecialchars(strip_tags($this->LIEN_OFFRE));
    $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));
    $this->ID_Offre=htmlspecialchars(strip_tags($this->ID_Offre));
    $this->ID_Utilisateur_Pilote=htmlspecialchars(strip_tags($this->ID_Utilisateur_Pilote));


    
    // Ajout des données protégées
    $query->bindParam(":Cv_etudiant", $this->Cv_etudiant);
    $query->bindParam(":lettre_de_motivation_etudiant", $this->lettre_de_motivation_etudiant);
    $query->bindParam(":Fiche_de_validation", $this->Fiche_de_validation);
    $query->bindParam(":Convention_de_stage", $this->Convention_de_stage);
    $query->bindParam(":LIEN_OFFRE", $this->LIEN_OFFRE);
    $query->bindParam(":ID_Utilisateur", $this->ID_Utilisateur);
    $query->bindParam(":ID_Offre", $this->ID_Offre);
    $query->bindParam(":ID_Utilisateur_Pilote", $this->ID_Utilisateur_Pilote);

    // Exécution de la requête
    if($query->execute()){
        return true;
    }
    return false;
}
    // Supprimer une candidature

    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE ID_candidature= ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->ID_candidature=htmlspecialchars(strip_tags($this->ID_candidature));

        // On attache l'id
        $query->bindParam(1, $this->ID_candidature);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }
    // Mettre à jour une candidature

    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . 
        " SET  Cv_etudiant = 
        :Cv_etudiant, 
        lettre_de_motivation_etudiant = :lettre_de_motivation_etudiant, 
        Fiche_de_validation = :Fiche_de_validation, 
        Convention_de_stage = :Convention_de_stage, 
        LIEN_OFFRE = :LIEN_OFFRE, 
        ID_Utilisateur = :ID_Utilisateur, 
        ID_Offre = :ID_Offre, 
        ID_Utilisateur_Pilote = :ID_Utilisateur_Pilote 
        WHERE ID_candidature = :ID_candidature";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->ID_candidature=htmlspecialchars(strip_tags($this->ID_candidature));
        $this->Cv_etudiant=htmlspecialchars(strip_tags($this->Cv_etudiant));
        $this->lettre_de_motivation_etudiant=htmlspecialchars(strip_tags($this->lettre_de_motivation_etudiant));
        $this->Fiche_de_validation=htmlspecialchars(strip_tags($this->Fiche_de_validation));
        $this->Convention_de_stage=htmlspecialchars(strip_tags($this->Convention_de_stage));
        $this->LIEN_OFFRE=htmlspecialchars(strip_tags($this->LIEN_OFFRE));
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));
        $this->ID_Offre=htmlspecialchars(strip_tags($this->ID_Offre));
        $this->ID_Utilisateur_Pilote=htmlspecialchars(strip_tags($this->ID_Utilisateur_Pilote));
        
        // On attache les variables
        $query->bindParam(":ID_candidature", $this->ID_candidature);
        $query->bindParam(":Cv_etudiant", $this->Cv_etudiant);
        $query->bindParam(":lettre_de_motivation_etudiant", $this->lettre_de_motivation_etudiant);
        $query->bindParam(":Fiche_de_validation", $this->Fiche_de_validation);
        $query->bindParam(":Convention_de_stage", $this->Convention_de_stage);
        $query->bindParam(":LIEN_OFFRE", $this->LIEN_OFFRE);
        $query->bindParam(":ID_Utilisateur", $this->ID_Utilisateur);
        $query->bindParam(":ID_Offre", $this->ID_Offre);
        $query->bindParam(":ID_Utilisateur_Pilote", $this->ID_Utilisateur_Pilote);
        
        // On exécute
        if($query->execute()){
            return true;
        }
        
        return false;
    }
    public function settable(string $table){

        $this->table = $table;
    }
}

?>