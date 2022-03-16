<?php
require("_admin_header.php");
require("_fonctions.php");
$id = false;
$error = false;
$color = false;
// -----------------------------------[ TRAITEMENT DU FORMULAIRE ]-----------
if($_POST) {
    //$id = is_numeric(trim($_GET["id"])) ? $_GET["id"] : $error = "Le format de l'identifiant de l'article est inconnu.", $color = "error";
    $id = is_numeric(trim($_GET["id"])) ? $_GET["id"] : $error = ["message" => "Le format de l'identifiant de l'article est inconnu.", "color" => "error"];
    //$cat = is_numeric(trim($_POST["categorie"])) ? $_POST["categorie"] : $error = "Le format de l'identifiant de la catégorie est inconnu.", $color = "error";
    $cat = is_numeric(trim($_POST["categorie"])) ? $_POST["categorie"] : $error = ["message" => "Le format de l'identifiant de la catégorie est inconnu.", "color" => "error"];
    //$nom = cleanString($_POST["name"]) != "" ? cleanString($_POST["name"]) : $error = "Le champs \"Nom\" est vide.", $color = "error";
    $nom = cleanString($_POST["name"]) != "" ? cleanString($_POST["name"]) : $error = ["message" => "Le champs \"Nom\" est vide.", "color" => "error"];
    //$description = cleanString($_POST["description"]) != "" ? cleanString($_POST["description"]) : $error = "Le champs \"Description\" est vide.", $color = "error";
    $description = cleanString($_POST["description"]) != "" ? cleanString($_POST["description"]) : $error = ["message" => "Le champs \"Description\" est vide.", "color" => "error"];
    //$img = ;// TODO ###################

    // Vérification des champs
    if($error == false) {// MAJ si tout est OK
        // var_dump(
        //     'ID = ' . $id . '<br>'.
        //     'Catégorie = ' . $cat . '<br>'.
        //     'Nom = ' . $nom . '<br>'.
        //     'Description = ' . $description
        // );
        echo "stop : != de false"; exit;
        /*$pdo = connexion();
        $sql = $pdo->prepare("UPDATE articles SET 
            nom = :name, 
            description = :details,
            idCategorie = :cat
            WHERE idArticle = :id");
        $sql->execute([
            "name" => $nom,
            "details" => $description,
            "cat" => $cat,
            "id" => $id
        ]);*/
        $error = "L'article a été modifié avec succès.";
        $color = ".check";
    }
}
// -----------------------------------[ TRAITEMENT DU FORMULAIRE : FiN! ]----

function selectArticle($i) {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles WHERE idArticle = $i");
    return $sql->fetch();
}
if(isset($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "edite") {
    $id = is_numeric(trim($_GET["id"])) ? $_GET["id"] : $error = ["message" => "Aucun article à afficher", "color" => "error"];
    $article = selectArticle($id);
}
?>

<main>
    <h1>ADMIN &raquo; Gestion d'un article</h1>
<?php
// Affichage d'une eventuelle erreur : 
if($error != false) {
    echo "<p class=\"". $error["color"] ."\">". $error["message"] ."</p>";
}
?>
    <form action="#" method="post" enctype="multipart/form-data">
        <table class="tabForm">
            <caption>ARTICLES #<?php echo $article["idArticle"]; ?></caption>
            <tbody>
                <tr>
                    <td><label for="name">Nom de l'article</label> : </td>
                    <td><input type="text" name="name" id="name" value="<?php echo $article["nom"]; ?>" placeholder="Champs vide interdit !"></td>
                </tr>
                <tr>
                    <td><label for="description">Description</label> : </td>
                    <td><textarea name="description" id="description" placeholder="Champs vide interdit !" cols="30" rows="10"><?php echo $article["description"]; ?></textarea></td>
                </tr>
                <tr>
                    <td><label for="categorie">Catégorie</label> : </td>
                    <td>
                        <select name="categorie" id="categorie">
                            <?php 
                            $pdo = connexion();
                            $sql = $pdo->query("SELECT * FROM categories ORDER BY nom");
                            $cato = $sql->fetchAll();
                            foreach($cato as $cat) {
                                $select = $cat["idCategorie"] == $article["idCategorie"] ? " selected" : "";
                                echo '<option value="'.$cat["idCategorie"].'"'.$select.'>'.$cat["nom"].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Illustration : </td>
                    <td>
                        <img src="<?php echo $article["image"]; ?>" class="img-mini" alt="image" class="img-mini">
                        <p><input type="file" name="img" id="img"></p>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Modifier"></td>
                </tr>
            </tbody>
        </table>
    </form>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</main>

<?php
require("footer.php");
?>
