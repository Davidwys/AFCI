<?php

require("header.php");
?>

<h1>Les Classiques</h1>
<section>
    <?php 
    $pdo = connexion();  // connexion BDD dans une variable ($pdo retournée de config..php)
    $sql = $pdo->query("SELECT * FROM articles"); //tu m'amènes la requete sur la table articles
    $articles = $sql->fetchAll(); //$articles = requeteSQL tu me ramènes
    
    foreach($articles as $produit){ 
        if($produit["categorie"] == 1){?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="<?php echo $produit["image"] ?>" alt="">
                <p>
                    <?php echo $produit["nom"] ?>
                </p>
                <p class="cardPrice">
                    
                <?php foreach ($categories as $produit){
                    if($produit["categorie"] == 1){echo $produit["petite"] ?> €
                </p>

                <p class="cardPrice">
                <?php if($produit["categorie"] == 1){echo $produit["grande"] ?> €
                </p>
                    <?php } ?>
            </div>
            <div class="cardBack">
                <p>Description :
                    <?php echo $produit["description"] ?>
                </p>
            </div>
        </div>
    </div>
    <?php }/* Fermeture du if*/} //fermeture du foreach ?>
</section>
<h1>Les Gourmandes</h1>

<section>
    <?php foreach($article as $produit){ 
        if($produit["categorie"] == 2){?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="<?php echo $produit["image"] ?>" alt="">
                <p>
                    <?php echo $produit["nom"] ?>
                </p>
                <p class="cardPrice">
                    
                <?php foreach ($categories as $produit){
                    if($produit["categorie"] == 1){echo $produit["petite"] ?> €
                </p>

                <p class="cardPrice">
                <?php if($produit["categorie"] == 1){echo $produit["grande"] ?> €
                </p>
                    <?php } ?>
            </div>
            <div class="cardBack">
                <p>Description :
                    <?php echo $produit["description"] ?>
                </p>
            </div>
        </div>
    </div>
    <?php }/* Fermeture du if*/} //fermeture du foreach ?>* Fermeture du if*/} //fermeture du foreach ?>
</section>
<h1>Les Spéciales</h1>

<section>
    <?php foreach($article as $produit){ 
        if($produit["categorie"] == 3){?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="<?php echo $produit["image"] ?>" alt="">
                <p>
                    <?php echo $produit["nom"] ?>
                </p>
                <p class="cardPrice">
                    
                <?php foreach ($categories as $produit){
                    if($produit["categorie"] == 1){echo $produit["petite"] ?> €
                </p>

                <p class="cardPrice">
                <?php if($produit["categorie"] == 1){echo $produit["grande"] ?> €
                </p>
                    <?php } ?>
            </div>
            <div class="cardBack">
                <p>Description :
                    <?php echo $produit["description"] ?>
                </p>
            </div>
        </div>
    </div>
    <?php }/* Fermeture du if*/} //fermeture du foreach ?>
</section>
<aside>
    <table class="panier">
        <h2>Votre panier</h2>
        <div class="productLine">
            <p><?php echo $produit["nom"] ?></p>
            <button id="plusUn">+</button>
            <button id="moinsUn">-</button>
            <button id="remove">supprimer X</button>
            <p><?php echo $produit["prix"] ?></p>
        </div>
        <div class="total">
            
            <p><?php echo $totalArticles ?></p>
            <p><?php echo $totalPrice ?></p>
        </div>
</table>
</aside>
<?php
require("footer.php");
?>