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
// TODO : Insérer le CSS suivant UNIQUEMENT si l'user est un administrateur
    echo '<link rel="stylesheet" href="_admin_style.css">';
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
                <li>Connexion</li>
            </ul>
        </nav>
    </header>