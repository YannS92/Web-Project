<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: POST, OPTIONS");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD'] == 'POST' || 'OPTIONS'){

    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'C:/www/htdocs/Api_Beta/Config/BDD.php';
    include_once 'C:/www/htdocs/Api_Beta/Models/Entreprise.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie l'objet Entreprise
    $utilisateur = new Entreprise($db);

    // On récupère les données reçues
    $donnees = json_decode(file_get_contents("php://input"));
 

    // On vérifie qu'on a bien toutes les données
    if(!empty($donnees->Nom_entreprise) && !empty($donnees->secteur_activite) && !empty($donnees->competences_recherchees_dans_les_stages) && !empty($donnees->nombre_de_stagiaires_CESI_deja_acceptes_en_stage)&& !empty($donnees->evaluation_des_stagiaires)&& !empty($donnees->confiance_du_Pilote_de_promotion)&& !empty($donnees->localite_entreprise)&& !empty($donnees->ID_Utilisateur)){

        $utilisateur->Nom_entreprise = $donnees->Nom_entreprise;
        $utilisateur->secteur_activite = $donnees->secteur_activite;
        $utilisateur->competences_recherchees_dans_les_stages = $donnees->competences_recherchees_dans_les_stages;
        $utilisateur->nombre_de_stagiaires_CESI_deja_acceptes_en_stage = $donnees->nombre_de_stagiaires_CESI_deja_acceptes_en_stage;
        $utilisateur->evaluation_des_stagiaires = $donnees->evaluation_des_stagiaires;
        $utilisateur->confiance_du_Pilote_de_promotion = $donnees->confiance_du_Pilote_de_promotion;
        $utilisateur->localite_entreprise = $donnees->localite_entreprise;
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;

        if($utilisateur->creer()){
            // Ici la création a fonctionné
            // On envoie un code 201
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    }


}else{
    // Mauvaise méthode, on gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
?>