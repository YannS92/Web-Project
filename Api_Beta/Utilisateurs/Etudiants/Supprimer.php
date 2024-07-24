<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: DELETE");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    
    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'C:/www/htdocs/Api_Beta/Config/BDD.php';
    include_once 'C:/www/htdocs/Api_Beta/Models/Users/Etudiants.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les utilisateurs
    $utilisateur = new Etudiants($db);
    //on récupère les données
    $donnees = json_decode(file_get_contents("php://input"));


    if(!empty($donnees->ID_Utilisateur)){
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;

        if($utilisateur->supprimer()){
            // Ici la suppression a fonctionné
            // On envoie un code 200
            http_response_code(200);
            echo json_encode(["message" => "La suppression a été effectuée"]);
        }else{
            // Ici la création n'a pas fonctionné
            // On envoie un code 503
            http_response_code(503);
            echo json_encode(["message" => "La suppression n'a pas été effectuée"]);         
        }
    }

}else{
    
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
?>