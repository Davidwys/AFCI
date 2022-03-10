<?php
require("_admin_header.php");
?>

<main>
    <h1>ADMIN &raquo; Gestion des articles</h1>
    <!-- TODO : lister chaque article par page avec les options (modifier/supprimer) -->

<?php
function selectAllUser() {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles ORDER BY DESC");
    return $sql->fetchAll();
}
?>


</main>

<?php
require("footer.php");
?>