<?php
class BDD{
    // Propriétés de  notre petite base de données
    private $host = "localhost";
    private $db_name = "Projet";
    private $username = "root";
    private $password = "";
    public $connexion;

    // get pour la connexion
    public function getConnection(){
        // On commence par fermer la connexion si elle existait
        $this->connexion = null;

        // On essaie de se connecter
        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8"); // On force les transactions en UTF-8
        }catch(PDOException $exception){ 
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        // et retourne la connexion
        return $this->connexion;
    }   
}
?>