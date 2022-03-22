<?php
require("_admin_header.php");
require("_fonctions.php");

if($_POST) {

}
?>

<main>
    <h1>ADMIN &raquo; Gestion des catégories</h1>
    <!-- TODO : Faire des liens vers les différentes page de l'administration :
        -> _admin_categories_liste.php => gestion des catégories (lister chaque article par page avec les options (modifier/supprimer))
        -> _admin_users_liste.php => gestion des users (lister chaque article par page avec les options (modifier/supprimer))
     -->
    <!-- ------------------------------------[ FORMULAIRE ]------------------------------------------ -->
     <form action="#" method="post" enctype="multipart/form-data">
        <table class="tabForm">
            <caption>Ajouter une catégorie</caption>
            <tbody>
                <tr>
                    <td><label for="name">Nom : </label></td>
                    <td><input type="text" name="name" id="name"></td>
                </tr>
                <tr>
                    <td><label for="small">Petite : </label></td>
                    <td><input type="text" name="small" id="small"></td>
                </tr>
                <tr>
                    <td><label for="big">Grande : </label></td>
                    <td><input type="text" name="big" id="big"></td>
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
            $categories = selectAllCategories();
            foreach($categories as $row) {
                // echo '<pre>';
                // var_dump($categories); exit;
                // echo '</pre>';
            ?>
            <tr>
                <td><?php echo $categories[0][$row]; ?></td>
                <td><?php echo $row[0]['petite']; ?></td>
                <td><?php echo $row[0]['grande']; ?></td>
                <td><a href="_admin_categories_edite.php?id=<?php echo $row[0]['idCategorie']; ?>&action=edite" title="Modifier"><img class="icon" src="assets/img/edite.png" alt="edite"></a></td>
                <td><a href="?id=<?php echo $row[0]['idCategorie']; ?>&action=delete" title="Supprimer"><img class="icon" src="assets/img/delete.png" alt="delete"></a></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
    <!-- --------------------------------------------------------------------------------------------- -->
</main>

<?php
require("footer.php");
?>