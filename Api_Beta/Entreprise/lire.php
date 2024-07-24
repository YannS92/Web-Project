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
    include_once 'C:/www/htdocs/Api_Beta/Models/Entreprise.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les Entreprise
    $utilisateur = new Entreprise($db);


    // On récupère les données
    $stmt = $utilisateur->lire();

    // On vérifie si on a au moins 1 produit
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauUtilisateurs = [];
        $tableauUtilisateurs['Entreprise'] = [];

    // On parcourt les produits
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $Users = [
            "id_entreprise"=>$id_entreprise,
            "Nom_entreprise"=>$Nom_entreprise,
            "secteur_activite"=>$secteur_activite,
            "competences_recherchees_dans_les_stages"=>$competences_recherchees_dans_les_stages,
            "nombre_de_stagiaires_CESI_deja_acceptes_en_stage"=>$nombre_de_stagiaires_CESI_deja_acceptes_en_stage,
           "evaluation_des_stagiaires" =>$evaluation_des_stagiaires,
            "confiance_du_Pilote_de_promotion"=> $confiance_du_Pilote_de_promotion,
            "localite_entreprise"=>$localite_entreprise,
           "ID_Utilisateur" => $ID_Utilisateur
        ];

        $tableauUtilisateurs['Entreprise'][] = $Users;
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