<?php
// On démarre la session PHP
session_start();
// Ici nous allons chercher les articles dans la base
// On commence par se connecter à la base avec un require_once
require_once "includes/connect.php";

// On écrit la requête
$sql = "SELECT * FROM `articles`";

// On execute la requête
$requete = $db->query($sql);

//On récupère les données
$articles = $requete->fetchAll();

$titre = "Listes des Articles disponible";
@include "includes/header.php";
@include "includes/nav.php";
?>

<h2>Liste des articles</h2>


<section>
    <?php foreach ($articles as $article) : ?>
        <article>
            <h3><a href="article.php?ID=<?= $article["ID"] ?>"><?= strip_tags($article["nom"]) ?></a></h3>
            <p><?= $article["content"] ?></p>
            <div>Prix : <?= strip_tags($article["prix"]) ?>€</div>
        </article>
    <?php endforeach; ?>
</section>


<?php
@include "includes/footer.php";
?>