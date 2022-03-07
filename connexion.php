<?php
require("header.php");
require("validate.class.php");
// Si c'est une connexion :
if(isset($_POST["connexion"])) {
    $connexion = new Validate;
    $connexion->checkEmail($_POST["email"]);
    $connexion->checkPassword($_POST["password"]);

    if(empty($connexion->erreur)) {
        // On identifie le visiteur :
        echo "Connexion ok !";
    } else {
        $error = $connexion->erreur;
    }
}
// Si c'est une inscription :
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
</main>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

<?php
require("footer.php");
?>