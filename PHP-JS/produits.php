<?php

function connexion(){
    $config = require("config.php");
    $dsn = "mysql:host=".$config["host"]
    .";dbname=".$config["database"]
    .";charset=".$config["charset"];
    try{
        $pdo = new PDO(
            $dsn,
            $config["user"],
            $config["password"],
            $config["options"]
        );
    }catch(\PDOException $e){
        throw new \PDOException(
            $e->getMessage(),
            $e->getCode());
    }
    return $pdo;
}

// on récupère toutes nos données
function selectAll(){
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM products");
    return $sql->fetchAll();
}
$products = selectAll();
// je transforme mes données en JSON
echo json_encode($products);

?>