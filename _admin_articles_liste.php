<?php
require("_admin_header.php");
?>

<main>
    <h1>ADMIN &raquo; Gestion des articles</h1>

<?php
function selectAllArticles() {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM articles ORDER BY nom DESC");
    return $sql->fetchAll();
}
$article = selectAllArticles();

function selectAllCategories() {
    $pdo = connexion();
    $sql = $pdo->query("SELECT * FROM categories ORDER BY nom DESC");
    return $sql->fetchAll(PDO::FETCH_GROUP|PDO::FETCH_ASSOC);
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
                <th></th>
                <th></th>
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