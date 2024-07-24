<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: POST");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD'] == 'POST'){

    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'C:/www/htdocs/Api_Beta/Config/BDD.php';
    include_once 'C:/www/htdocs/Api_Beta/Models/Candidature.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les utilisateurs
    $utilisateur = new Candidature($db);

    // On récupère les données reçues
    $donnees = json_decode(file_get_contents("php://input"));
 

    // On vérifie qu'on a bien toutes les données
    if(!empty($donnees->LIEN_OFFRE) &&!empty($donnees->ID_Utilisateur) && !empty($donnees->ID_Offre)&& !empty($donnees->ID_Utilisateur_Pilote)){
      
        $utilisateur->Cv_etudiant = $donnees->Cv_etudiant ;
        $utilisateur->lettre_de_motivation_etudiant = $donnees->lettre_de_motivation_etudiant;
        $utilisateur->Fiche_de_validation = $donnees->Fiche_de_validation;
        $utilisateur->Convention_de_stage = $donnees->Convention_de_stage;
        $utilisateur->LIEN_OFFRE = $donnees->LIEN_OFFRE;
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;
        $utilisateur->ID_Offre = $donnees->ID_Offre;
        $utilisateur->ID_Utilisateur_Pilote = $donnees->ID_Utilisateur_Pilote;
        
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