<?php
require("_admin_header.php");
require("_fonctions.php");

$id = false;
$error = false;
$color = false;

function deleteCategorie($id) {// --------------------------------------[ SUPPRIME UNE CATéGORIE ]--------------
    $pdo = connexion ();
    $sql = $pdo->prepare("DELETE FROM categories WHERE idCategorie = :id");
    $sql->execute(["id" => $id]);
    return true;
}// ----------------------------------------------------------------------------------------------------------
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "delete") {
    // Sélection de la catégorie : son image surtout !
    $cat = selectCategorie($_GET["id"]);
    $cat = $cat["image"];
    if(deleteCategorie($_GET["id"])) {//--- TODO : à améliorer car, même si la catégorie n'existe pas, se sera TRUE !
        // file_exists($cat) ?? unlink($cat);
        file_exists($cat) ? unlink($cat) : null;
        //echo $cat;
        $error = ["message" => "La catégorie a été supprimée !", "color" => "check"];
    } else {
        $error = ["message" => "La catégorie a supprimer n'existe pas !?", "color" => "error"];
    }
}

// -----------------------------------[ TRAITEMENT DU FORMULAIRE ]--------------------------------------------
if($_POST && isset($_GET["action"]) && $_GET["action"] == "add") {
    $name = cleanString($_POST["name"]) != "" ? cleanString($_POST["name"]) : $error = ["message" => "Le champs \"Nom\" est vide.", "color" => "error"];
    /* TODO : vérifier que le nom n'existe pas déjà dans la BDD */
    $small = is_numeric($_POST["small"]) != "" ? ($_POST["small"]) : $error = ["message" => "Le champs \"Petite\" est vide.", "color" => "error"];
    $big = is_numeric($_POST["big"]) != "" ? ($_POST["big"]) : $error = ["message" => "Le champs \"Grande\" est vide.", "color" => "error"];
    $img = false;

    if(is_uploaded_file($_FILES["img"]["tmp_name"])) {
        // Un tableau contenant les types mimes acceptés.
        $typesPermis = ["image/png", "image/jpeg", "image/gif"];
        //Le chemin menant au dossier où l'on rangera nos fichiers.
        $targetDir = "assets/img/";

        // basename permet de retirer les possibles chemin de dossier jusqu'au fichier ne gardant que son nom.
        $file = basename($_FILES["img"]["name"]);
        /* uniqid génère une valeur aléatoire sensé être unique. Les paramètres sont optionnels.
        Le 1er permet d'ajouter un préfix, le second d'augmenter l'antropie (l'aléatoire)*/
        $file = uniqid("", true).$file;
        /* On concatène le nom du fichier avec le chemin où il doit être rangé.*/
        $targetFile = $targetDir . $file;
        // équivalent en 1 seule ligne :
        // $file = $targetDir . uniqid(date("U"), true) . basename($_FILES["img"]["name"]);

        /* mime_content_type vérifie le type du fichier.
        On l'utilise pour éviter de croire simplement les informations envoyé par le formulaire. */
        $mimeType = mime_content_type($_FILES["img"]["tmp_name"]);

        if(file_exists($targetFile)) {
            $error = ["message" => "Ce fichier existe déjà.", "color" => "error"];
        }
        if(!in_array($mimeType, $typesPermis)) {
            $error = ["message" => "Ce type de fichier n'est pas accepté.", "color" => "error"];
        }
        if($_FILES["img"]["size"] > 5000000) {
            $error = ["message" => "Ce fichier est trop lourd (supérieur à 5 MB)", "color" => "error"];
        }
        /* move_uploaded_file déplace un fichier téléversé depuis la zone temporaire jusqu'à son emplacement final et, retourne "true" si tout s'est bien passé sinon "false" ! */
        $moveImg = move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
        $moveImg == true ? $img = $targetFile : $error = ["message" => "Le fichier n'a pas pu être téléversé.", "color" => "error"];
    }

    // Vérification des champs
    if($error == false) {// MAJ si tout est OK
        
        $img = $img != false ? $img : "";
        $pdo = connexion();
        $sql = $pdo->prepare("INSERT INTO categories (nom, petite, grande, image) VALUES (:name, :small, :big, :img)");
        $sql->execute([
            'name' => $name,
            'small' => $small,
            'img' => $img,
            'big' => $big
        ]);
        $error = ["message" => "L'article a été ajouté avec succès.", "color" => "check"];
    }
}
// -----------------------------------[ TRAITEMENT DU FORMULAIRE : FiN! ]--------------------------------------------
?>

<main>
    <h1>ADMIN &raquo; Gestion des catégories</h1>
    <!-- TODO : Faire des liens vers les différentes page de l'administration :
        -> _admin_users_liste.php => gestion des users (lister chaque article par page avec les options (modifier/supprimer))
     -->
    <?php
    // Affichage d'une eventuelle erreur : 
    if($error != false) {
        echo "<p class=\"". $error["color"] ."\">". $error["message"] ."</p>";
    }
    ?>
    <!-- ------------------------------------[ FORMULAIRE ]------------------------------------------ -->
     <form action="_admin_categories_liste.php?action=add" method="post" enctype="multipart/form-data">
        <table class="tabForm">
            <caption>Ajouter une catégorie</caption>
            <tbody>
                <tr>
                    <td><label for="name">Nom : </label></td>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
                <tr>
                    <td><label for="small">Petite : </label></td>
                    <td><input type="number" step="0.01" name="small" id="small"></td>
                </tr>
                <tr>
                    <td><label for="big">Grande : </label></td>
                    <td><input type="number" step="0.01" name="big" id="big"></td>
                </tr>
                <tr>
                    <td><label for="img">Illustration : </label></td>
                    <td><input type="file" name="img" id="img"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Ajouter"></td>
                </tr>
            </tbody>
        </table>
    </form><!-- -------------------------------------------------------------------------------------- -->

    <!-- ------------------------------------[ LISTE DES CATéGORIES ]--------------------------------- -->
    <table>
        <caption>LISTE DES CATEGORIES</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Petite</th>
                <th>Grande</th>
                <th colspan="2">Options</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $categories = selectAllCategories2();
            foreach($categories as $row) {
            ?>
            <tr>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['petite']; ?></td>
                <td><?php echo $row['grande']; ?></td>
                <td><a href="_admin_categories_edite.php?id=<?php echo $row['idCategorie']; ?>&action=edite" title="Modifier"><img class="icon" src="assets/img/edite.png" alt="edite"></a></td>
                <td><a href="?id=<?php echo $row['idCategorie']; ?>&action=delete" title="Supprimer"><img class="icon" src="assets/img/delete.png" alt="delete"></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <!-- --------------------------------------------------------------------------------------------- -->
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p>&nbsp;</p>

</main>

<?php
require("footer.php");
?>