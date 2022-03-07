<?php
// Ajout d'un utilisateur en BDD
function ajout($username, $password, $email, $file) {
    $pdo = connexion();
    // On enregistre les données en BDD
    $sql = $pdo->prepare(
        "INSERT INTO user (username, email, password, image) VALUES (:user, :em, :pass, :im)"
    );
    $sql->execute([
        "user" => $username,
        "em" => $email,
        "pass" => $password,
        "im" => $file
    ]);
}

// Sélection de l'utilisateur en BDD
function selectByEmail($email) {
    // Je récupère la connexion
    $pdo = connexion();
    // Je prépare la requête
    $sql = $pdo->prepare("SELECT * FROM user WHERE email=:em");
    // J'execute la requête
    $sql->execute(["em" => $email]);
    // Je retourne les informations trouvé.
    return $sql->fetch();
}

function selectAll() {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM user");// On ne prépare pas puisque l'on "sélectionne" SANS DANGER ;) --> On ne modifie rien ;)
    /* Ici, je m'attends à plusieurs résultats et non un seul comme la fonction précédente.
    J'utilise donc "fetchAll" plutôt que "fetch" qui ne m'en rendrait qu'un seul. */
    return $sql->fetchAll();
}

/* On va déclarer une fonction "selectById" prenant un id en paramètre et sélectionnant les informations de l'utilisateur dont l'id est égale à notre paramètre id.
Pour cela on va appeler la fonction connexion,
faire une requête préparé,
l'exécuter, et retourner nos informations avec un "fetch". 
(cette focntion est la même que selectByEmail mais avec un id)*/
function selectById($id) {
    // Je récupère la connexion
    $pdo = connexion();
    // Je prépare la requête
    $sql = $pdo->prepare("SELECT * FROM user WHERE id=:id");
    // J'execute la requête
    $sql->execute(["id" => $id]);
    // Je retourne les informations trouvé.
    return $sql->fetch();
}

/* On déclare une fonction "update" prenant en paramètre l'id, username, email et apssword.
Ensuite on se connecte.
On prépare une requête avec "UPDATE user SET ... WHERE ..." où dans notre SET on va modifier l'username, l'e-mail et le mot de passe et dans notre WHERE indiquer l'id de l'utilisateur à modifier.
Ensuite on execute notre requête. */
function update($id, $username, $email, $password) {
    $pdo = connexion();
    $sql = $pdo->prepare("UPDATE user SET username=:us, email=:em, password=:mdp WHERE id=:id");
    $sql->execute([
        "id" => $id,
        "em" => $email,
        "mdp" => $password,
        "us" => $username
    ]);
}

function delete($id) {
    $pdo = connexion();
    $sql = $pdo->prepare("DELETE FROM user WHERE id=:id");
    $sql->execute(["id" => $id]);
}

?>