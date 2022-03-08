<?php
require("header.php");
require("validate.class.php");
// Si il y a une demande de connexion :
if(isset($_POST["connexion"])) {
    $connexion = new Validate;
    $email = $connexion->checkEmail($_POST["email"]);
    $password = $connexion->checkPassword($_POST["password"]);

    if(empty($connexion->erreur)) {
        // On identifie le visiteur :
        // 1 - on sélectionne l'utilisateur en BDD grâce aux infos transmis avec le formulaire de connexion (e-mail et mot de passe).
        if(selectByEmail($email)) {// si l'e-mail est présent en BDD
            // On compare son mot de passe avec celui en BDD :
            
            
            // On fini en créant les variables de session local :
            
        } else {
            $error = "L'utilisateur n'existe pas !";
        }
        
    } else {
        $error = $connexion->erreur;
    }
}
// Si il y a une demande d'inscription :
if(isset($_POST["inscription"])) {
    echo "inscription";
}
?>

<main class="connexion">
    <h1>Page de connexion et d'inscription</h1>

<?php
if(isset($error)) {
    echo "\n\t<article class=\"error\">\n";
    foreach($error as $message) {
        echo "\t\t" . $message . "<br>\n";
    }
    echo "\t</article>\n";
}
// Si le visiteur est déjà connecté :
if(isset($_SESSION["role"])) {
    echo "\t<p>Bienvenue à la pizzeria des Papas !</p>";
} else {
?>

    <form action="#" method="post" class="form-1">
        <div class="form-1-titre">Connectez-vous</div>
        <label for="email">E-mail</label><input type="text" name="email" id="email">
        <label for="password">Mot de passe</label><input type="password" name="password" id="password">
        <input type="submit" value="Connexion">
        <input type="hidden" name="connexion">
    </form>
    <p>&nbsp;</p>
    <p>ou</p>
    <p>&nbsp;</p>
    <form action="#" method="post" class="form-1">
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