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
?>