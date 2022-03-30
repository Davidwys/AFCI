<?php
require("_admin_header.php");
?>

<main>
    <h1>ADMIN &raquo; Accueil de l'administration du site</h1>
    <!-- TODO : Faire des liens vers les différentes page de l'administration :
        -> _admin_articles_liste.php => gestion des articles (lister chaque article par page avec les options (modifier/supprimer))
        -> _admin_categories_liste.php => même chose pour les catégorie ;)
        -> _admin_users_liste.php => même chose pour les users ;)
     -->
     <div class="adm-home">
        <!-- TODO : Afficher le nbr d'articles en BDD, le nbr d'utilisateurs, le nbr de catégories, autre ? -->
        <article class="adm-box adm-articles">
            <h2><a href="_admin_articles_liste.php">Gestion des articles</a></h2>
            <p>Page d'administration des articles</p>
        </article>
        <article class="adm-box adm-categories">
            <h2><a href="_admin_categories_liste.php">Gestion des catégories</a></h2>
            <p>Page d'administration des catégories</p>
        </article>
        <article class="adm-box adm-users">
            <h2><a href="_admin_users_liste.php">Gestion des utilisateurs</a></h2>
            <p>Page d'administration des utilisateurs</p>
        </article>
     </div>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
     <p>&nbsp;</p>
</main>

<?php
require("footer.php");
?>