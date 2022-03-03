<?php
// On démarre la session PHP
session_start();
// On vérifie si on a un id
if (!isset($_GET["ID"]) || empty($_GET["ID"])) {
    // Si je n'ai pas d'id
    header("Location: acticles.php");
    exit; // Je repars
}

// Je récupère l'id
$id = $_GET["ID"];

// Ici nous allons chercher les articles dans la base
// On commence par se connecter à la base avec un require_once
require_once "includes/connect.php";

// On va chercher l'article dans la base
// On écrit la requête
$sql = "SELECT * FROM `articles` WHERE `ID` = :ID";


// On prépare la requête
$requete = $db->prepare($sql);

// On injecte les paramètres pour empêcher les injections de script (Faille XSS)
$requete->bindValue(":ID", $id, PDO::PARAM_INT);

// On execute la requête
$requete->execute();

// On récupère l'article
$article = $requete->fetch();

// On vérifie si l'article est vide ! signifi Not
if (!$article) {
    // Pas d'article = erreur 404
    http_response_code(404);
    echo "Article inexistant";
    exit;
}

// Ici on a un article

// On définit le titre
// la fonction strip_tags permet de protéger les failles Xss, injections de script dans la base de donnée
$titre = strip_tags($article["nom"]);

@include "includes/header.php";
@include "includes/nav.php";

?>
<article class="center">
    <h1><?= strip_tags($article["nom"]) ?></h1>
    <p>Description : <?= $article["content"] ?>.</p>
    <div>Prix : <?= strip_tags($article["prix"]) ?>€</div>
</article>
<?php
@include "includes/footer.php";
?>