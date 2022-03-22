<?php
require("_admin_header.php");
include('_fonctions.php');

$id = false;
$error = false;
$color = false;
// -----------------------------------[ TRAITEMENT DU FORMULAIRE ]--------------------------------------------
if($_POST) {
    // En cas d'erreur, je crée un tableau pour récupérer le message d'erreur et sa classe couleur ;)
    $nom = cleanString($_POST["name"]) != "" ? cleanString($_POST["name"]) : $error = ["message" => "Le champs \"Nom\" est vide.", "color" => "error"];
    $description = cleanString($_POST["description"]) != "" ? cleanString($_POST["description"]) : $error = ["message" => "Le champs \"Description\" est vide.", "color" => "error"];
    $img = false;
    $cat = is_numeric(trim($_POST["categorie"])) ? $_POST["categorie"] : $error = ["message" => "Le format de l'identifiant de la catégorie est inconnu.", "color" => "error"];

    if(is_uploaded_file($_FILES["img"]["tmp_name"])) {
        // Un tableau contenant les types mimes acceptés.
        $typesPermis = ["image/png", "image/jpeg", "image/gif"];
        //Le chemin menant au dossier où l'on rangera nos fichiers.
        $targetDir = "assets/img/";

        // basename permet de retirer les possibles chemin de dossier jusqu'au fichier ne gardant que son nom.
        $file = basename($_FILES["img"]["name"]);
        /* uniqid génère une valeur aléatoire sensé être unique. Les paramètres sont optionnels.
        Le 1er permet d'ajouter un préfix, le second d'augmenter l'antropie (l'aléatoire)*/
        $file = uniqid("", true).$file;
        /* On concatène le nom du fichier avec le chemin où il doit être rangé.*/
        $targetFile = $targetDir . $file;
        // équivalent en 1 seule ligne :
        // $file = $targetDir . uniqid(date("U"), true) . basename($_FILES["img"]["name"]);

        /* mime_content_type vérifie le type du fichier.
        On l'utilise pour éviter de croire simplement les informations envoyé par le formulaire. */
        $mimeType = mime_content_type($_FILES["img"]["tmp_name"]);

        if(file_exists($targetFile)) {
            $error = ["message" => "Ce fichier existe déjà.", "color" => "error"];
        }
        if(!in_array($mimeType, $typesPermis)) {
            $error = ["message" => "Ce type de fichier n'est pas accepté.", "color" => "error"];
        }
        if($_FILES["img"]["size"] > 5000000) {
            $error = ["message" => "Ce fichier est trop lourd (supérieur à 5 MB)", "color" => "error"];
        }
        /* move_uploaded_file déplace un fichier téléversé depuis la zone temporaire jusqu'à son emplacement final et, retourne "true" si tout s'est bien passé sinon "false" ! */
        $moveImg = move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile);
        $moveImg == true ? $img = $targetFile : $error = ["message" => "Le fichier n'a pas pu être téléversé.", "color" => "error"];
    }

    // Vérification des champs
    if($error == false) {// MAJ si tout est OK
        
        $img = $img != false ? $img : "";

        $pdo = connexion();
        $sql = $pdo->prepare("INSERT INTO articles (nom, description, image, idcategorie) VALUES (:nom, :des, :img, :cat)");
        $sql->execute([
            'nom' => $nom,
            'des' => $description,
            'img' => $img,
            'cat' => $cat
        ]);
        $error = ["message" => "L'article a été ajouté avec succès.", "color" => "check"];
    }
}
// -----------------------------------[ TRAITEMENT DU FORMULAIRE : FiN! ]--------------------------------------------
?>

<main>
    <h1>ADMIN &raquo; Ajouter un article</h1>

    <?php
    // Affichage d'une eventuelle erreur : 
    if($error != false) {
        echo "<p class=\"". $error["color"] ."\">". $error["message"] ."</p>";
    }
    ?>
    
    <form action="#" method="post" enctype="multipart/form-data">
        <table class="tabForm">
            <caption>NOUVEL ARTICLE</caption>
            <tbody>
                <tr>
                    <td><label for="name">Nom de l'article</label> : </td>
                    <td><input type="text" name="name" id="name" placeholder="Champs vide interdit !"></td>
                </tr>
                <tr>
                    <td><label for="description">Description</label> : </td>
                    <td><textarea name="description" id="description" placeholder="Champs vide interdit !" cols="30" rows="10"></textarea></td>
                </tr>
                <tr>
                    <td><label for="categorie">Catégorie</label> : </td>
                    <td>
                        <select name="categorie" id="categorie">
                            <?php 
                            $pdo = connexion();
                            $sql = $pdo->query("SELECT * FROM categories ORDER BY nom");
                            $cato = $sql->fetchAll();
                            foreach($cato as $cat) {
                                $select = $cat["idCategorie"] == $article["idCategorie"] ? " selected" : "";
                                echo '<option value="'.$cat["idCategorie"].'"'.$select.'>'.$cat["nom"].'</option>';
                            }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Illustration : </td>
                    <td class="center">
                        <p><input type="file" name="img" id="img"></p>
                        <!-- TODO : (1)Personnaliser ce bouton "Parcourir" -->
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Ajouter"></td>
                </tr>
            </tbody>
        </table>
    </form>
    
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>&nbsp;</p>

</main>

<?php
require("footer.php");
?>