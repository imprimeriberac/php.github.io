<?php
// On démarre la session PHP
session_start();
if (isset($_SESSION["user"])) {
    header("Location: profil.php");
    exit;
}
// On vérifie si le formulaire a été envoyé
if (!empty($_POST)) {
    // Le formulaire a été envoyé
    // On vérifie que TOUS les champs requis sont remplis
    if (
        isset($_POST["email"], $_POST["pass"])
        && !empty($_POST["email"] && !empty($_POST["pass"]))
    ) {
        // On vérifie que l'email en est un
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("ce n'est pas un email");
        }

        // On se connecte à la base de donnée
        require_once "includes/connect.php";

        $sql = "SELECT * FROM `users` WHERE `email` = :email";

        $query = $db->prepare($sql);

        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        $user = $query->fetch();

        if (!$user) {
            die("L'utilisateur est incorrect");
        }

        // Ici on a un user existant, on peut vérifier le mot de passe
        if (!password_verify($_POST["pass"], $user["pass"])) {
            die("le mot de passe est incorrect");
        }

        // Ici l'utilisateur et le mot de passe sont corrects
        // On va pouvoir "connecter" l'utilisateur

        //  On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $user["id"],
            "pseudo" => $user["name"],
            "email" => $user["email"],
            "roles" => $user["roles"]
        ];

        // On redirige vers la page de profil (par exemple)
        header("Location: profil.php");
    }
}
?>

<?php
$titre = "Connexion";
@include "includes/header.php";
@include "includes/nav.php";
?>

<h2>Connexion</h2>

<form method="post">
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">Me connecter</button>
</form>

<?php
@include "includes/footer.php";
