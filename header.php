<?php
require("config.php");
session_start();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>La pizzeria des Papas</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="desserts.css">
<?php
// Si le visiteur est un administrateur, j'ajoute le CSS pour les pages d'administration
if(isset($_SESSION["role"]) && $_SESSION["role"] == "administrateur") {
    echo '<link rel="stylesheet" href="_admin_style.css">';
}
?>
</head>
<body>
    <header>
        <img src="" alt="">
        <nav>
            <ul>
                <li>Les Pizzas</li>
                <li>Les Boissons</li>
                <li>Les Desserts</li>
<?php
// Le visiteur est-il connecté ? :
if(!isset($_SESSION["role"])) {// Si, pas connecté, on affiche le lien de connexion
                echo '<li><a href="connexion.php">Connexion</a></li>';
} elseif(isset($_SESSION["role"]) && $_SESSION["role"] == "administrateur") {// Si connecté et, que c'est un "administrateur"
    // On affiche le lien vers la page d'administration du site
                echo '<li><a href="_admin.php">Administration</a></li>';    
} else {// Sinon, ça ne peut être qu'un client connecté !
                echo '<li>Bonjour !</li>';
}
?>
                
            </ul>
        </nav>
    </header>