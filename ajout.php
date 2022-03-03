<?php

// On traite le formulaire
if (!empty($_POST)) {
    // POST n'est pas vide, on vérifie que toutes les données sont présentes
    if (
        isset($_POST["titre"], $_POST["content"]) && !empty($_POST["titre"]) && !empty($_POST["content"])
    ) {
        // Le formulaire est complet
        // On récupère les données en les protégeants (Failles XSS)
        // On retire toute les balises du titre
        $titre = strip_tags($_POST["titre"]);
        // On neutralise toute les balises du contenu
        $contenu = htmlspecialchars($_POST["content"]);
        $price = strip_tags($_POST["price"]);

        // On peut les enregistrer
        // On se connect à la base
        require_once "includes/connect.php";

        // On écrit la requête
        $sql = "INSERT INTO `articles`(`nom`, `content`, `prix`) VALUES (:nom, :content, :prix)";

        // On prépare la requête
        $query = $db->prepare($sql);

        // On injecte les valeurs
        $query->bindValue(":nom", $titre, PDO::PARAM_STR);
        $query->bindValue(":content", $contenu, PDO::PARAM_STR);
        $query->bindValue(":prix", $price, PDO::PARAM_INT);

        // On exécute la requête
        if (!$query->execute()) {
            die("Une erreur est survenue");
        }

        // On récupère l'id de l'article
        $id = $db->lastInsertId();

        die("Article ajouté sous le numéro $id");
    } else {
        die("le formulaire est incomplet");
    }
}

$titre = "Ajouter un article";
// On inclut le header
include_once "includes/header.php";
include_once "includes/nav.php";
?>
<h2>Ajouter un article</h2>

<form method="post">
    <div>
        <label for="titre">Titre</label>
        <input type="text" name="titre" id="titre">
    </div>
    <div>
        <label for="price">Prix</label>
        <input type="text" name="price" id="price">
    </div>
    <div>
        <label for="content">Contenu</label>
        <textarea name="content" id="content"></textarea>
    </div>
    <button type="submit">Enregistrer</button>
</form>

<?php
include_once "includes/footer.php";
