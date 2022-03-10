<?php
session_start();

//Si on tente d'accéder à une page d'administration sans être "administrateur" :
if(substr(basename($_SERVER['SCRIPT_NAME']), 0, 6) == '_admin' && $_SESSION['role'] != "administrateur") {
    header("location:connexion.php");
    exit();
}

// TODO : Si il y a une demande d'inscription :

// Si il y a une demande de déconnexion :
if(isset($_GET['v']) && $_GET['v'] == 'exit') {
    logout();
    // Puis on affiche un petit message à notre utilisateur
    $error = "Merci de votre visite, à très bientôt ;)";
    $errorClass = "no-error";
}
function logout() {
    // On vide nos variable de session.
    $_SESSION = [];

    // On met fin à la session.
    session_destroy();
}

require("config.php");
require("validate.class.php");
require("user.class.php");

// Si il y a une demande de connexion :
if(isset($_POST["connexion"])) {
    $connexion = new Validate;
    $email = $connexion->checkEmail($_POST["email"]);
    $password = $connexion->checkPassword($_POST["password"]);
    //var_dump($password);

    if(empty($connexion->erreur)) {
        // On identifie le visiteur :
        // 1 - on sélectionne l'utilisateur en BDD grâce aux infos transmis avec le formulaire de connexion (e-mail et mot de passe).
        $user = selectByEmail($email);
        //var_dump($user);
        if($user) {// si l'e-mail est présent en BDD
            if(password_verify($password, $user["password"])) {
                /* Je range dans les variables de session dans les index de mon choix, les valeurs prouvant que l'utilisateur est connecté. */
                $_SESSION["role"] = $user["role"];
                $_SESSION["idUser"] = $user["idUser"];
                $_SESSION["email"] = $user["email"];
                
            } else {// Si le mot de passe ne correspond pas
                $error = "Mot de passe incorrecte.";
                $errorClass = "error";
            }
        } else {
            $error = "L'utilisateur n'existe pas !";
            $errorClass = "error";
        }
    } else {
        $error = $connexion->erreur;
        $errorClass = "error";
    }
}

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
    echo '<li><a href="connexion.php?v=exit">Déconnexion</a></li>';
} else {// Sinon, ça ne peut être qu'un client connecté !
    echo '<li><a href="connexion.php?v=exit">Déconnexion</a></li>';
}
?>
                
            </ul>
        </nav>
    </header>