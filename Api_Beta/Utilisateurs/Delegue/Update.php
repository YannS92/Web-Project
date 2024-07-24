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
    include_once 'C:/www/htdocs/Api_Beta/Models/Users/Delegue.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les Pilotes
    $utilisateur = new Delegue($db);
   
    // On récupère les données reçues
    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->ID_Utilisateur) && !empty($donnees->centre_Delegue) && !empty($donnees->promotions_Delegue) && !empty($donnees->Droits_Delegue) && !empty($donnees->NOM) && !empty($donnees->PRENOM) && !empty($donnees->Login) && !empty($donnees->Mot_de_passe) && !empty($donnees->ID_Utilisateur__Assigne_DROIT) && !empty($donnees->ID_Utilisateur__CREE) ){
     
        // On hydrate notre objet
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;
        $utilisateur->centre_Delegue = $donnees->centre_Delegue ;
        $utilisateur->promotions_Delegue = $donnees->promotions_Delegue;
        $utilisateur->Droits_Delegue = $donnees->Droits_Delegue;
        $utilisateur->NOM = $donnees->NOM;
        $utilisateur->PRENOM = $donnees->PRENOM;
        $utilisateur->Login = $donnees->Login;
        $utilisateur->Mot_de_passe = $donnees->Mot_de_passe;
        $utilisateur->ID_Utilisateur__Assigne_DROIT = $donnees->ID_Utilisateur__Assigne_DROIT;
        $utilisateur->ID_Utilisateur__CREE = $donnees->ID_Utilisateur__CREE;

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