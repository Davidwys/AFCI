<?php
/* ===============[ QUELQUES FONCTIONS UTILES ]=============================================== */
// Traite les caractères spéciaux pour éviter d'insérer n'importe quoi en BDD ;)
function cleanString($var) {
    return htmlspecialchars(stripslashes(trim($var)));
}

?>