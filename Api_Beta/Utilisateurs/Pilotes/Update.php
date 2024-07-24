<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: PUT, OPTIONS");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'PUT'|| 'OPTIONS'){
   
    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'C:/www/htdocs/Api_Beta/Config/BDD.php';
    include_once 'C:/www/htdocs/Api_Beta/Models/Users/Pilotes.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les Pilotes
    $utilisateur = new Pilotes($db);

    // On récupère les données reçues
    $donnees = json_decode(file_get_contents("php://input"));
    if(!empty($donnees->ID_Utilisateur) && !empty($donnees->centre_pilote) && !empty($donnees->promotions_pilote) && !empty($donnees->NOM) && !empty($donnees->PRENOM) && !empty($donnees->Login) && !empty($donnees->Mot_de_passe)&& !empty($donnees->ID_Utilisateur_Administrateur) ){
                // On hydrate notre objet
        $utilisateur->ID_Utilisateur = $donnees->ID_Utilisateur;
        $utilisateur->centre_pilote = $donnees->centre_pilote ;
        $utilisateur->promotions_pilote = $donnees->promotions_pilote;
        $utilisateur->NOM = $donnees->NOM;
        $utilisateur->PRENOM = $donnees->PRENOM;
        $utilisateur->Login = $donnees->Login;
        $utilisateur->Mot_de_passe = $donnees->Mot_de_passe;
        $utilisateur->ID_Utilisateur_Administrateur = $donnees->ID_Utilisateur_Administrateur;

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