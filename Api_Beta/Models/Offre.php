<?php

class Offre{
    // Connexion à la BDD
    private $connexion;
    private $table = "offre"; // Table dans la base de données

    // Propriétés
  public  $ID_Offre ;
  public  $competences_offre;
  public  $localite_offre ;
  public  $Entreprise_offre ;
  public  $types_de_promotions_concernees ;
  public  $duree_du_stage ;
  public  $base_de_remuneration ;
  public  $date_offre;
  public  $nombre_de_places_offertes_aux_etudiants;
  public  $id_entreprise ;
  public $ID_Utilisateur;



    // Constructeur avec $db pour la connexion à la base de données

    public function __construct($db){
        $this->connexion = $db;
    }

//Lecture des utilisateur, fonction retourne un void

public function lire(){
    //  requête en sql 
    $sql = "SELECT*  FROM " . $this->table ;

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
    " SET competences_offre=:competences_offre, 
    localite_offre=:localite_offre,
     Entreprise_offre=:Entreprise_offre, 
     types_de_promotions_concernees=:types_de_promotions_concernees, 
     duree_du_stage=:duree_du_stage, base_de_remuneration=:base_de_remuneration, 
     date_offre=:date_offre, nombre_de_places_offertes_aux_etudiants=:nombre_de_places_offertes_aux_etudiants, 
     id_entreprise=:id_entreprise, 
     ID_Utilisateur=:ID_Utilisateur";

    // Préparation de la requête
    $query = $this->connexion->prepare($sql);

    // Protection contre les injections
    $this->competences_offre=htmlspecialchars(strip_tags($this->competences_offre));
    $this->localite_offre=htmlspecialchars(strip_tags($this->localite_offre));
    $this->Entreprise_offre=htmlspecialchars(strip_tags($this->Entreprise_offre));
    $this->types_de_promotions_concernees=htmlspecialchars(strip_tags($this->types_de_promotions_concernees));
    $this->duree_du_stage=htmlspecialchars(strip_tags($this->duree_du_stage));
    $this->base_de_remuneration=htmlspecialchars(strip_tags($this->base_de_remuneration));
    $this->date_offre=htmlspecialchars(strip_tags($this->date_offre));
    $this->nombre_de_places_offertes_aux_etudiants=htmlspecialchars(strip_tags($this->nombre_de_places_offertes_aux_etudiants));
    $this->id_entreprise=htmlspecialchars(strip_tags($this->id_entreprise));
    $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));

    
    // Ajout des données protégées
    $query->bindParam(":competences_offre", $this->competences_offre);
    $query->bindParam(":localite_offre", $this->localite_offre);
    $query->bindParam(":Entreprise_offre", $this->Entreprise_offre);
    $query->bindParam(":types_de_promotions_concernees", $this->types_de_promotions_concernees);
    $query->bindParam(":duree_du_stage", $this->duree_du_stage);
    $query->bindParam(":base_de_remuneration", $this->base_de_remuneration);
    $query->bindParam(":date_offre", $this->date_offre);
    $query->bindParam(":nombre_de_places_offertes_aux_etudiants", $this->nombre_de_places_offertes_aux_etudiants);
    $query->bindParam(":id_entreprise", $this->id_entreprise);
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
        $sql = "DELETE FROM " . $this->table . " WHERE ID_Offre= ?";

        // On prépare la requête
        $query = $this->connexion->prepare( $sql );

        // On sécurise les données
        $this->ID_Offre=htmlspecialchars(strip_tags($this->ID_Offre));

        // On attache l'id
        $query->bindParam(1, $this->ID_Offre);

        // On exécute la requête
        if($query->execute()){
            return true;
        }
        
        return false;
    }
    // Mettre à jour un produit

    public function modifier(){
        // On écrit la requête
        $sql = "UPDATE " . $this->table . 
        " SET competences_offre=:competences_offre, localite_offre=:localite_offre, 
        Entreprise_offre=:Entreprise_offre, 
        types_de_promotions_concernees=:types_de_promotions_concernees, 
        duree_du_stage=:duree_du_stage, base_de_remuneration=:base_de_remuneration, 
        date_offre=:date_offre, nombre_de_places_offertes_aux_etudiants=:nombre_de_places_offertes_aux_etudiants, 
        id_entreprise=:id_entreprise, 
        ID_Utilisateur=:ID_Utilisateur 
        WHERE ID_Offre = :ID_Offre";
        
        // On prépare la requête
        $query = $this->connexion->prepare($sql);
        
        // On sécurise les données
        $this->ID_Offre=htmlspecialchars(strip_tags($this->ID_Offre));
        $this->competences_offre=htmlspecialchars(strip_tags($this->competences_offre));
        $this->localite_offre=htmlspecialchars(strip_tags($this->localite_offre));
        $this->Entreprise_offre=htmlspecialchars(strip_tags($this->Entreprise_offre));
        $this->types_de_promotions_concernees=htmlspecialchars(strip_tags($this->types_de_promotions_concernees));
        $this->duree_du_stage=htmlspecialchars(strip_tags($this->duree_du_stage));
        $this->base_de_remuneration=htmlspecialchars(strip_tags($this->base_de_remuneration));
        $this->date_offre=htmlspecialchars(strip_tags($this->date_offre));
        $this->nombre_de_places_offertes_aux_etudiants=htmlspecialchars(strip_tags($this->nombre_de_places_offertes_aux_etudiants));
        $this->id_entreprise=htmlspecialchars(strip_tags($this->id_entreprise));
        $this->ID_Utilisateur=htmlspecialchars(strip_tags($this->ID_Utilisateur));
        
        // On attache les variables
        $query->bindParam(":ID_Offre", $this->ID_Offre);
        $query->bindParam(":competences_offre", $this->competences_offre);
        $query->bindParam(":localite_offre", $this->localite_offre);
        $query->bindParam(":Entreprise_offre", $this->Entreprise_offre);
        $query->bindParam(":types_de_promotions_concernees", $this->types_de_promotions_concernees);
        $query->bindParam(":duree_du_stage", $this->duree_du_stage);
        $query->bindParam(":base_de_remuneration", $this->base_de_remuneration);
        $query->bindParam(":date_offre", $this->date_offre);
        $query->bindParam(":nombre_de_places_offertes_aux_etudiants", $this->nombre_de_places_offertes_aux_etudiants);
        $query->bindParam(":id_entreprise", $this->id_entreprise);
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