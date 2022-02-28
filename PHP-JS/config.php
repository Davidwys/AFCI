<?php 
// Configuration pour se connecter.
    return array(
        // l'host est l'endroit où se situe ma BDD
        "host"=>"localhost",
        // On a besoin du nom de la BDD
        "database"=> "classicmodels",
        // Il nous faut le nom d'utilisateur
        "user"=> "root",
        // Il faut le mot de passe :
        "password"=> "",
        // Quel charset est utilisé 
        "charset" => "utf8mb4",
        // On met les options de PDO. (PHP Data Object)
        "options" => 
        [
            // Mode d'affichage des erreurs.
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            // Comment sont retourné les données 
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            // On désactive la vérification de compatibilité du driver
            // avec les requêtes préparés.
            PDO::ATTR_EMULATE_PREPARES => false
        ]
    );
?>