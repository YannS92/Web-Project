<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: PUT,OPTIONS");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'PUT' || 'OPTIONS'){
   
    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'C:/www/htdocs/Api_Beta/Config/BDD.php';
    include_once 'C:/www/htdocs/Api_Beta/Models/Offre.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les utilisateurs
    $utilisateur = new Offre($db);

    // On récupère les données reçues
    $donnees = json_decode(file_get_contents("php://input"));
    if(!empty($donnees->ID_Offre) &&!empty($donnees->competences_offre) && !empty($donnees->localite_offre) && !empty($donnees->Entreprise_offre) && !empty($donnees->types_de_promotions_concernees)&& !empty($donnees->duree_du_stage)&& !empty($donnees->base_de_remuneration)&& !empty($donnees->date_offre)&& !empty($donnees->nombre_de_places_offertes_aux_etudiants)&& !empty($donnees->ID_Utilisateur)){

        // On hydrate notre objet
        $utilisateur->ID_Offre = $donnees->ID_Offre;
        $utilisateur->competences_offre = $donnees->competences_offre;
        $utilisateur->localite_offre = $donnees->localite_offre;
        $utilisateur->Entreprise_offre = $donnees->Entreprise_offre;
        $utilisateur->types_de_promotions_concernees = $donnees->types_de_promotions_concernees;
        $utilisateur->duree_du_stage = $donnees->duree_du_stage;
        $utilisateur->base_de_remuneration = $donnees->base_de_remuneration;
        $utilisateur->date_offre = $donnees->date_offre;
        $utilisateur->nombre_de_places_offertes_aux_etudiants = $donnees->nombre_de_places_offertes_aux_etudiants;
        $utilisateur->id_entreprise = $donnees->id_entreprise;
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;

        if($utilisateur->modifier()){
            // Ici la modification a fonctionné
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(["message" => "La modification a été effectuée"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "La modification n'a pas été effectuée"]);  
        }
    }
}else{
 
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}



?>