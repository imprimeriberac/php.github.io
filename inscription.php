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
        isset($_POST["nickname"], $_POST["email"], $_POST["pass"]) && !empty($_POST["nickname"]) && !empty($_POST["email"]) && !empty($_POST["pass"])
    ) {
        // Le formulaire est complet
        // On récupère les données en les protégeants
        $pseudo = strip_tags($_POST["nickname"]);
        // Vérifier que l'email à bien la syntaxe d'un mail
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            die("L'adresse email n'est pas valide");
        }

        // On va hasher le mot de passe
        $pass = password_hash($_POST["pass"], PASSWORD_ARGON2ID);

        // Ajoutez ici tous les contrôles souhaités

        // On enregistre en base de données
        require_once "includes/connect.php";

        $sql = "INSERT INTO `users`(`name`, `pass`, `email`, `roles`) VALUES (:pseudo, '$pass', :email, '[\"ROLE_USER\"]')";

        $query = $db->prepare($sql);

        $query->bindValue(":pseudo", $pseudo, PDO::PARAM_STR);
        $query->bindValue(":email", $_POST["email"], PDO::PARAM_STR);

        $query->execute();

        // On récupère l'id du nouvelle utilisateur
        $id = $db->lastInsertId();

        // On connectera l'utilisateur directement ici

        //  On stocke dans $_SESSION les informations de l'utilisateur
        $_SESSION["user"] = [
            "id" => $id,
            "pseudo" => $pseudo,
            "email" => $_POST["email"],
            "roles" => $user["ROLE_USER"]
        ];

        // On redirige vers la page de profil (par exemple)
        header("Location: profil.php");
    } else {
        die("Le formulaire est incomplet");
    }
}
?>

<?php
$titre = "Inscription";
@include "includes/header.php";
@include "includes/nav.php";
?>

<h2>Inscription</h2>

<form method="post">
    <div>
        <label for="pseudo">Pseudo</label>
        <input type="text" name="nickname" id="pseudo">
    </div>
    <div>
        <label for="email">Email</label>
        <input type="email" name="email" id="email">
    </div>
    <div>
        <label for="pass">Mot de passe</label>
        <input type="password" name="pass" id="pass">
    </div>
    <button type="submit">M'inscrire</button>
</form>

<?php
@include "includes/footer.php";
