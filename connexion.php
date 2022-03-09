<?php
require("header.php");

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