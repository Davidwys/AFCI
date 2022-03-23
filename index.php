<?php

require("header.php");
?>

<h1>Les Classiques</h1>
<section>
    <?php 
    $pdo = connexion();  // connexion BDD dans une variable ($pdo retournée de config..php)
    $sql = $pdo->query("SELECT * FROM articles"); //tu m'amènes la requete sur la table articles
    $articles = $sql->fetchAll(); //$articles = requeteSQL tu me ramènes
    $sql2 = $pdo->query("SELECT * FROM categories");
    $categories = $sql->fetchAll();
    
    foreach($articles as $produit){ 
        //var_dump($produit);
        if($produit["idCategorie"] == 1){?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="<?php echo $produit["image"] ?>" alt="">
                <p>
                    <?php echo $produit["nom"] ?>
                </p>
                <p class="cardPrice">
                <button>
                    <h3 class="prixPetite">
                        <?php foreach ($categories as $produit){
                            if($produit["idCategorie"] == 1){echo $produit["petite"]; } ?> €
                        </p>
                    </h3>
                </button>

                <p class="cardPrice">
                <button>
                    <h3 class="grandePrix">
                        <?php if($produit["idCategorie"] == 1){echo $produit["grande"]; } ?> €
                        </p>
                    </h3>
                </button>
                

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
    <?php foreach($articles as $produit){ 
        if($produit["idCategorie"] == 2){?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="<?php echo $produit["image"] ?>" alt="">
                <p>
                    <?php echo $produit["nom"] ?>
                </p>
                <p class="cardPrice">
                <button>
                    <h3 class="prixPetite">   
                        <?php foreach ($categories as $produit){
                            if($produit["idCategorie"] == 1){echo $produit["petite"]; } ?> €
                        </p>
                    </h3>
                </button>
                <p class="cardPrice">
                <button>
                    <h3 class="grandePrix">
                        <?php if($produit["idCategorie"] == 1){echo $produit["grande"]; } ?> €
                        </p>
                    </h3>
                </button>    
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
<h1>Les Spéciales</h1>

<section>
    <?php foreach($articles as $produit){ 
        if($produit["idCategorie"] == 3){?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="<?php echo $produit["image"] ?>" alt="">
                <p>
                    <?php echo $produit["nom"] ?>
                </p>
                <p class="cardPrice">
                <button>
                    <h3 class="prixPetite">  
                        <?php foreach ($categories as $produit){
                            if($produit["idCategorie"] == 1){echo $produit["petite"]; } ?> €
                    </h3>
                </button>
                <button>
                    <h3 class="grandePrix">
                        <?php if($produit["idCategorie"] == 1){echo $produit["grande"]; } ?> €
                    </h3>
                </button>
                <?php } ?>
                </p>    
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
        <div class="contenuPanier">
            <p><?php echo $produit["nom"] ?></p>

            <p><?php echo $produit["prix"] ?></p>
        </div>
        <div class="colsPxUnitaire">
            <button id="plusUn">+</button>
            <button id="moinsUn">-</button>
            <button id="remove">supprimer X</button>
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