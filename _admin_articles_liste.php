<?php
require("_admin_header.php");
?>

<main>
    <h1>ADMIN &raquo; Gestion des articles</h1>

<?php
$error = false;
function selectAllArticles() {// -------------------------------------[ SéLECTIONNE TOUS LES ARTICLES ]-------
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles ORDER BY nom DESC");
    return $sql->fetchAll();
}// ----------------------------------------------------------------------------------------------------------
$article = selectAllArticles();

function selectAllCategories() {// -----------------------------------[ SéLECTIONNE TOUTES LES CATéGORIES ]---
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM categories ORDER BY nom DESC");
    return $sql->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
}// ----------------------------------------------------------------------------------------------------------

function deleteArticle($id) {// --------------------------------------[ SUPPRIME UN ARTICLE ]-----------------
    $pdo = connexion ();
    $sql = $pdo->prepare("DELETE FROM articles WHERE idArticle = :id");
    $sql->execute(["id" => $id]);
}// ----------------------------------------------------------------------------------------------------------

if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "delete") {
    if(deleteArticle($_GET["id"])) {
        $error = ["message" => "L'article a été supprimé !", "color" => "check"];
    } else {
        $error = ["message" => "L'article a supprimer n'existe pas !?", "color" => "error"];
    }
}

// Affichage d'une eventuelle erreur : 
if($error != false) {
    echo "<p class=\"". $error["color"] ."\">". $error["message"] ."</p>";
}

$categories = selectAllCategories();
/*echo "<pre>";
var_export($categories);
echo "</pre>";*/
?>

    <table>
        <caption>LISTE DES ARTICLES</caption>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th colspan="2"><a href="_admin_article_new.php"><img class="icon" src="assets/img/add.png" alt="add"></a></th>
            </tr>
        </thead>
        <tbody>
<?php
foreach($article as $row) {
?>
            <tr>
                <td><?php echo $row['nom']; ?></td>
                <td><?php echo $row['description']; ?></td>
                <td class="center"><?php echo $categories[$row['idCategorie']][0]["nom"]; ?></td>
                <td class="center"><a href="_admin_article_edite.php?id=<?php echo $row['idArticle']; ?>&action=edite" title="Modifier"><img class="icon" src="assets/img/edite.png" alt="edite"></a></td>
                <td class="center"><a href="#?id=<?php echo $row['idArticle']; ?>&action=delete" title="Supprimer"><img class="icon" src="assets/img/delete.png" alt="delete"></a></td>
            </tr>
<?php
}
?>
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