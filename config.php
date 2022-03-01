<?php
/* FICHIER D'INFORMATIONS POUR LA CONNEXION à LA BDD */
return array(
    "host" => "localhost",
    "db" => "projet_pizza",
    "user" => "root",
    "password" => "",
    "charset" => "utf8mb4",
    "options" => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false
    ]
);

# --------------- CONNEXION ------------- #
$config = require("config.php");

/* 
$dsn = "mysql:host=localhost;dbname=firstCrud;charset=utf8mb4"
*/
$dsn = 
    "mysql:host=".$config["host"]
    .";dbname=".$config["db"]
    .";charset=".$config["charset"];
// On demande à PHP d'essayer de se connecter
try{
    $pdo = new PDO(
        $dsn,
        $config["user"],
        $config["password"],
        $config["options"]
    );
/* Si il n'y a pas d'erreur, le catch est ignoré, sinon il 
lancera l'erreur */
}catch(\PDOException $e){ // la variable $e doit être de type PDOException
    // On demande à PDO Exception 
    // d'afficher le message d'erreur et son code.
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}

?>