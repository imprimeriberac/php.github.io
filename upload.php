<?php
$titre = "Ajouter un article";
// On inclut le header
include_once "includes/header.php";
include_once "includes/nav.php";
?>

<h2>Ajout de fichiers</h2>
<form action="post">
    <div>
        <label for="fichier">Fichier</label>
        <input type="file" name="image" id="fichier">
    </div>
    <button type="submit">Envoyer</button>
</form>

<?php
include_once "includes/footer.php";
