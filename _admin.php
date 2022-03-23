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
     <h2><a href="_admin_articles_liste.php">Gestion des articles</a></h2>
     <p>Page d'administration des articles</p>
     <h2><a href="_admin_categories_liste.php">Gestion des catégories</a></h2>
     <p>Page d'administration des catégories</p>
     <h2><a href="_admin_users_liste.php">Gestion des utilisateurs</a></h2>
     <p>Page d'administration des utilisateurs
         <!-- TODO : Afficher le nbr d'articles en BDD, le nbr d'utilisateurs, le nbr de catégories, autre ? -->
     </p>
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