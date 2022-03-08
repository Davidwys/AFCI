<?php
require("header.php");
require("validate.class.php");
require("user.class.php");

// Si il y a une demande de déconnexion
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

//------------------------------------ TODO 

// Si il y a une demande de connexion :
if(isset($_POST["connexion"])) {
    $connexion = new Validate;
    $email = $connexion->checkEmail($_POST["email"]);
    $password = $connexion->checkPassword($_POST["password"]);
    var_dump($password);

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
// Si il y a une demande d'inscription :
if(isset($_POST["inscription"])) {// ========================[ TODO ! ]===
    echo "inscription";
}
?>

<main class="connexion">
    <h1>Page de connexion et d'inscription</h1>

<?php
if(isset($error)) {
    echo "\n\t<article class=\"" . $errorClass . "\">\n";
    /*foreach($error as $message) {
        echo "\t\t" . $message . "<br>\n";
    }*/
    echo "\t\t" . $error . "<br>\n";
    echo "\t</article>\n";
}
// Si le visiteur est déjà connecté :
if(isset($_SESSION["role"])) {
    echo "\t<p>Bienvenue à la pizzeria des Papas !</p>";
    echo "<p>Role => " . $_SESSION["role"] . "<br>";
    echo "ID => " . $_SESSION["idUser"] . "<br>";
    echo "Email => " . $_SESSION["email"] . "</p>";
} else {
?>

    <form action="connexion.php" method="post" class="form-1">
        <div class="form-1-titre">Connectez-vous</div>
        <label for="email">E-mail</label><input type="text" name="email" id="email">
        <label for="password">Mot de passe</label><input type="password" name="password" id="password">
        <input type="submit" value="Connexion">
        <input type="hidden" name="connexion">
    </form>
    <p>&nbsp;</p>
    <p>ou</p>
    <p>&nbsp;</p>
    <form action="connexion.php" method="post" class="form-1">
        <div class="form-1-titre">Inscrivez-vous</div>
        <label for="email">E-mail</label><input type="text" name="email" id="email">
        <label for="password">Mot de passe</label><input type="password" name="password" id="password">
        <input type="submit" value="Inscription">
        <input type="hidden" name="inscription">
    </form>
<?php
}
?>
</main>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
require("footer.php");
?>