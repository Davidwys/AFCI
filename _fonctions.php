<?php
/* ===============[ QUELQUES FONCTIONS UTILES ]=============================================== */
// Traite les caractères spéciaux pour éviter d'insérer n'importe quoi en BDD ;)
function cleanString($var) {
    return htmlspecialchars(stripslashes(trim($var)));
}

function selectArticle($i) {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles WHERE idArticle = $i");
    return $sql->fetch();
}

function selectAllCategories() {// -----------------------------------[ SéLECTIONNE TOUTES LES CATéGORIES ]---
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM categories ORDER BY nom DESC");
    return $sql->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
}// ----------------------------------------------------------------------------------------------------------
?>