<?php

// Headers requis
// Accès depuis n'importe quel site ou appareil (*)
header("Access-Control-Allow-Origin: *");

// Format des données envoyées
header("Content-Type: application/json; charset=UTF-8");

// Méthode autorisée
header("Access-Control-Allow-Methods: GET");

// Durée de vie de la requête
header("Access-Control-Max-Age: 3600");

// Entêtes autorisées
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


if($_SERVER['REQUEST_METHOD'] == 'GET'){

    // On inclut les fichiers de configuration et d'accès aux données
    include_once 'C:/www/htdocs/Api_Beta/Config/BDD.php';
    include_once 'C:/www/htdocs/Api_Beta/Models/Candidature.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les Entreprise
    $utilisateur = new Candidature($db);


    // On récupère les données
    $stmt = $utilisateur->lire();

    // On vérifie si on a au moins 1 produit
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauUtilisateurs = [];
        $tableauUtilisateurs['Candidature'] = [];

    // On parcourt les produits
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);
        $Users = [
             "ID_candidature"=>$ID_candidature ,
             "Cv_etudiant"=>$Cv_etudiant,
             "lettre_de_motivation_etudiant"=>$lettre_de_motivation_etudiant ,
             "Fiche_de_validation"=>$Fiche_de_validation ,
             "Convention_de_stage"=> $Convention_de_stage ,
             "LIEN_OFFRE"=>$LIEN_OFFRE ,
             "ID_Utilisateur"=>$ID_Utilisateur,
             "ID_Offre"=>$ID_Offre,
             "ID_Utilisateur_Pilote"=>$ID_Utilisateur_Pilote ,

        ];

        $tableauUtilisateurs['Candidature'][] = $Users;
    }
    // On envoie le code réponse 200 OK
    http_response_code(200);

    // On encode en json et on envoie
    echo json_encode($tableauUtilisateurs);
    }
}else{
    // Mauvaise méthode, on gère l'erreur
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
?>