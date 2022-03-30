<?php
/* ===============[ QUELQUES FONCTIONS UTILES ]=============================================== */
// Traite les caractères spéciaux pour éviter d'insérer n'importe quoi en BDD ;)
function cleanString($var) {
    return htmlspecialchars(stripslashes(trim($var)));
}
// -----------------------------------------------------------------------------------------------------------
function selectUsers() {// -------------------------------------------[ SéLECTIONNE TOUS LES USERS ]----------
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM users ORDER BY email ASC");
    return $sql->fetchAll();
}
function selectUser($i) {// -------------------------------------------[ SéLECTIONNE UN USER ]----------------
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM users WHERE idUser = $i");
    return $sql->fetch();
}
// -----------------------------------------------------------------------------------------------------------
function selectArticle($i) {// ---------------------------------------[ SéLECTIONNE UN ARTICLE ]--------------
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles WHERE idArticle = $i");
    return $sql->fetch();
}
// -----------------------------------------------------------------------------------------------------------
function selectCategorie($i) {// -------------------------------------[ SéLECTIONNE UNE CATéGORIE ]-----------
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM categories WHERE idCategorie = $i");
    return $sql->fetch();
}
function selectAllCategories() {// -----------------------------------[ SéLECTIONNE TOUTES LES CATéGORIES ]---
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM categories ORDER BY nom ASC");
    return $sql->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
}
function selectAllCategories2() {// ----------------------------------[ SéLECTIONNE TOUTES LES CATéGORIES ]---
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM categories ORDER BY nom ASC");
    return $sql->fetchAll();
}// ----------------------------------------------------------------------------------------------------------
?>