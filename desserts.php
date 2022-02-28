<?php

require("header.php");


?>
<section>
    <h1>Des cerfs</h1>

<?php
// Appelle les catégories 8 ou 9 ... soit les desserts et les glaces
// SELECT * FROM articles WHERE idCategorie = 8 OR idCategorie = 9

// SELECT * FROM categories WHERE idCategorie = $articles->idCategorie 
?>
    <div class="cardContainer">
        <div class="card">
            <div class="cardFront">
                <img src="img/istockphoto-1087873980-612x612.jpg" alt="">
                <p>
                    <?php echo $articles->nom; ?> 
                </p>
                <p class="cardPrice">
                    <?php echo $categories->petite; ?>
                </p>
            </div>
            <div class="cardBack">
                <a href="" class="btn">
                    Consultez notre carte
                </a>
            </div>
        </div>
    </div>
</section>
<?php

require("footer.php");

?>