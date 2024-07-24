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
    include_once 'C:/www/htdocs/Api_Beta/Models/Offre.php';

    // On instancie la base de données
    $database = new BDD();
    $db = $database->getConnection();

    // On instancie les Entreprise
    $utilisateur = new Offre($db);


    // On récupère les données
    $stmt = $utilisateur->lire();

    // On vérifie si on a au moins 1 produit
    if($stmt->rowCount() > 0){
        // On initialise un tableau associatif
        $tableauUtilisateurs = [];
        $tableauUtilisateurs['Offre'] = [];

    // On parcourt les produits
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $Users = [
             "ID_Offre"=>$ID_Offre ,
             "competences_offre"=>$competences_offre,
             "localite_offre"=>$localite_offre ,
             "Entreprise_offre"=>$Entreprise_offre ,
             "types_de_promotions_concernees"=> $types_de_promotions_concernees ,
             "duree_du_stage"=>$duree_du_stage ,
             "base_de_remuneration"=>$base_de_remuneration ,
             "date_offre"=>$date_offre,
             "nombre_de_places_offertes_aux_etudiants"=>$nombre_de_places_offertes_aux_etudiants,
             "id_entreprise"=>$id_entreprise ,
             "ID_Utilisateur"=>$ID_Utilisateur,
        ];

        $tableauUtilisateurs['Offre'][] = $Users;
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