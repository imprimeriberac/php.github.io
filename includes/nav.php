<nav>
    <h1>Barre de Navigation</h1>
    <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="articles.php">Articles</a></li>
        <li><a href="ajout.php">Ajouter un article</a></li>
        <li><a href="upload.php">Ajouter un fichier</a></li>
        <?php if (!isset($_SESSION["user"])) : ?>
            <li><a href="inscription.php">M'inscrire</a></li>
            <li><a href="connexion.php">Connexion</a></li>
        <?php else : ?>
            <li><a href="deconnexion.php">Déconnexion</a></li>
        <?php endif; ?>
        <li><a href="#">Contact</a></li>
    </ul>
</nav>