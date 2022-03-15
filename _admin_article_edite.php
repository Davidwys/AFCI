<?php
require("_admin_header.php");

$id = false;
$error = false;

function selectArticle($i) {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles WHERE idArticle = $i");
    return $sql->fetch();
}
if(isset($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "edite") {
    $id = is_numeric(trim($_GET["id"])) ? $_GET["id"] : $error = "get-id-nonum";
    if($error === false) {
        $article = selectArticle($id);
    }
}
?>

<main>
    <h1>ADMIN &raquo; Gestion d'un article</h1>

    <table class="tabForm">
        <caption>ARTICLES #<?php echo "id de l'article"; ?></caption>
        <tbody>
            <tr>
                <td><label for="name">Nom de l'article</label> : </td>
                <td><input type="text" name="name" id="name" value="<?php echo $article["nom"]; ?>" placeholder="Champs vide interdit !"></td>
            </tr>
            <tr>
                <td><label for="description">Description</label> : </td>
                <td><textarea name="description" id="description" placeholder="Champs vide interdit !"><?php echo $article["description"]; ?></textarea></td>
            </tr>
            <tr>
                <td><label for="categorie">Catégorie</label> : </td>
                <td>
                    <select name="categorie" id="categorie">
                        <option value=""></option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Illustration : </td>
                <td>
                    <img src="" alt="image" class="img-mini">
                    <p><input type="file" name="img" id="img"></p>
                </td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Modifier"></td>
            </tr>
        </tbody>
    </table>
    
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</main>

<?php
require("footer.php");
?>
