<?php

class Entreprise{
    // Connexion à la BDD
    private $connexion;
    private $table = "entreprise"; // Table dans la base de données

    // Propriétés
  public $id_entreprise;
  public $Nom_entreprise;
  public $secteur_activite;
  public $competences_recherchees_dans_les_stages;
  public $nombre_de_stagiaires_CESI_deja_acceptes_en_stage;
  public $evaluation_des_stagiaires;
  public $confiance_du_Pilote_de_promotion;
  public $localite_entreprise;
  public $ID_Utilisateur;


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
    $sql = "INSERT INTO " . $this->table . 
    " SET Nom_entreprise=:Nom_entreprise, 
    secteur_activite=:secteur_activite, 
    competences_recherchees_dans_les_stages=:competences_recherchees_dans_les_stages, 
    nombre_de_stagiaires_CESI_deja_acceptes_en_stage=:nombre_de_stagiaires_CESI_deja_acceptes_en_stage, 
    evaluation_des_stagiaires=:evaluation_des_stagiaires, 
    confiance_du_Pilote_de_promotion=:confiance_du_Pilote_de_promotion, 
    localite_entreprise=:localite_entreprise, ID_Utilisateur=:ID_Utilisateur";

    // Préparation de la requête
    $query = $this->connexion->prepare($sql);

    // Protection contre les injections
    $this->Nom_entreprise=htmlspecialchars(strip_tags($this->Nom_entreprise));
    $this->secteur_activite=htmlspecialchars(strip_tags($this->secteur_activite));
    $this->competences_recherchees_dans_les_stages=htmlspecialchars(strip_tags($this->competences_recherchees_dans_les_stages));
    $this->nombre_de_stagiaires_CESI_deja_acceptes_en_stage=htmlspecialchars(strip_tags($this->nombre_de_stagiaires_CESI_deja_acceptes_en_stage));
    $this->evaluation_des_stagiaires=htmlspecialchars(strip_tags($this->evaluation_des_stagiaires));
    $this->confiance_du_Pilote_de_promotion=htmlspecialchars(strip_tags($this->confiance_du_Pilote_de_promotion));
    $this->localite_entreprise=htmlspecialchars(strip_tags($this->localite_entreprise));
    $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));

    // Ajout des données protégées
    $query->bindParam(":Nom_entreprise", $this->Nom_entreprise);
    $query->bindParam(":secteur_activite", $this->secteur_activite);
    $query->bindParam(":competences_recherchees_dans_les_stages", $this->competences_recherchees_dans_les_stages);
    $query->bindParam(":nombre_de_stagiaires_CESI_deja_acceptes_en_stage", $this->nombre_de_stagiaires_CESI_deja_acceptes_en_stage);
    $query->bindParam(":evaluation_des_stagiaires", $this->evaluation_des_stagiaires);
    $query->bindParam(":confiance_du_Pilote_de_promotion", $this->confiance_du_Pilote_de_promotion);
    $query->bindParam(":localite_entreprise", $this->localite_entreprise);
    $query->bindParam(":ID_Utilisateur", $this->ID_Utilisateur);

    // Exécution de la requête
    if($query->execute()){
        return true;
    }
    return false;
}
    // Supprimer un produit

    public function supprimer(){
        // On écrit la requête
        $sql = "DELETE FROM " . $this->table . " WHERE id_entreprise= ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->id_entreprise=htmlspecialchars(strip_tags($this->id_entreprise));

        // On attache l'id
        $query->bindParam(1, $this->id_entreprise);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }
    // Mettre à jour un produit

    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . " SET Nom_entreprise=:Nom_entreprise, secteur_activite=:secteur_activite, competences_recherchees_dans_les_stages=:competences_recherchees_dans_les_stages, nombre_de_stagiaires_CESI_deja_acceptes_en_stage=:nombre_de_stagiaires_CESI_deja_acceptes_en_stage, evaluation_des_stagiaires=:evaluation_des_stagiaires, confiance_du_Pilote_de_promotion=:confiance_du_Pilote_de_promotion, localite_entreprise=:localite_entreprise, ID_Utilisateur=:ID_Utilisateur WHERE id_entreprise = :id_entreprise";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->id_entreprise=htmlspecialchars(strip_tags($this->id_entreprise));
        $this->Nom_entreprise=htmlspecialchars(strip_tags($this->Nom_entreprise));
        $this->secteur_activite=htmlspecialchars(strip_tags($this->secteur_activite));
        $this->competences_recherchees_dans_les_stages=htmlspecialchars(strip_tags($this->competences_recherchees_dans_les_stages));
        $this->nombre_de_stagiaires_CESI_deja_acceptes_en_stage=htmlspecialchars(strip_tags($this->nombre_de_stagiaires_CESI_deja_acceptes_en_stage));
        $this->evaluation_des_stagiaires=htmlspecialchars(strip_tags($this->evaluation_des_stagiaires));
        $this->confiance_du_Pilote_de_promotion=htmlspecialchars(strip_tags($this->confiance_du_Pilote_de_promotion));
        $this->localite_entreprise=htmlspecialchars(strip_tags($this->localite_entreprise));
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));
        
        // On attache les variables
        $query->bindParam(":id_entreprise", $this->id_entreprise);
        $query->bindParam(":Nom_entreprise", $this->Nom_entreprise);
        $query->bindParam(":secteur_activite", $this->secteur_activite);
        $query->bindParam(":competences_recherchees_dans_les_stages", $this->competences_recherchees_dans_les_stages);
        $query->bindParam(":nombre_de_stagiaires_CESI_deja_acceptes_en_stage", $this->nombre_de_stagiaires_CESI_deja_acceptes_en_stage);
        $query->bindParam(":evaluation_des_stagiaires", $this->evaluation_des_stagiaires);
        $query->bindParam(":confiance_du_Pilote_de_promotion", $this->confiance_du_Pilote_de_promotion);
        $query->bindParam(":localite_entreprise", $this->localite_entreprise);
        $query->bindParam(":ID_Utilisateur", $this->ID_Utilisateur);
        
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