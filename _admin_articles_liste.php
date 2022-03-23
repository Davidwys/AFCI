<?php
require("_admin_header.php");
include('_fonctions.php');
?>

<main>
    <h1>ADMIN &raquo; Gestion des articles</h1>

<?php
$error = false;

function deleteArticle($id) {// --------------------------------------[ SUPPRIME UN ARTICLE ]-----------------
    $pdo = connexion ();
    $sql = $pdo->prepare("DELETE FROM articles WHERE idArticle = :id");
    $sql->execute(["id" => $id]);
    return true;
}// ----------------------------------------------------------------------------------------------------------
if(isset($_GET["id"]) && is_numeric($_GET["id"]) && isset($_GET["action"]) && $_GET["action"] == "delete") {
    // Sélection de l'article : son image surtout !
    $article = selectArticle($_GET["id"]);
    $article = $article["image"];
    //echo $article; exit;
    if(deleteArticle($_GET["id"])) {//--- TODO : à améliorer car, même si l'article n'existe pas, sera TRUE !
        unlink($article);
        $error = ["message" => "L'article a été supprimé !", "color" => "check"];
    } else {
        $error = ["message" => "L'article a supprimer n'existe pas !?", "color" => "error"];
    }
}

function selectAllArticles() {// -------------------------------------[ SéLECTIONNE TOUS LES ARTICLES ]-------
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles ORDER BY nom DESC");
    return $sql->fetchAll();
}// ----------------------------------------------------------------------------------------------------------
$article = selectAllArticles();
// Affichage d'une eventuelle erreur : 
if($error != false) {
    echo "<p class=\"". $error["color"] ."\">". $error["message"] ."</p>";
}

$categories = selectAllCategories();
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
                <td class="center"><a href="?id=<?php echo $row['idArticle']; ?>&action=delete" title="Supprimer"><img class="icon" src="assets/img/delete.png" alt="delete"></a></td>
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