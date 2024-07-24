<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: PUT");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'PUT'){
   
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
    if(!empty($donnees->ID_Utilisateur) && !empty($donnees->ID_Offre)&& !empty($donnees->ID_Utilisateur_Pilote) && !empty($donnees->ID_candidature)){

        // On hydrate notre objet
        $utilisateur->ID_candidature = $donnees->ID_candidature ;
        $utilisateur->Cv_etudiant = $donnees->Cv_etudiant ;
        $utilisateur->lettre_de_motivation_etudiant = $donnees->lettre_de_motivation_etudiant;
        $utilisateur->Fiche_de_validation = $donnees->Fiche_de_validation;
        $utilisateur->Convention_de_stage = $donnees->Convention_de_stage;
        $utilisateur->LIEN_OFFRE = $donnees->LIEN_OFFRE;
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;
        $utilisateur->ID_Offre = $donnees->ID_Offre;
        $utilisateur->ID_Utilisateur_Pilote = $donnees->ID_Utilisateur_Pilote;
        

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