<?php
// Je démarre ma session pour mettre un terme à ma session (deconnexion)
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: connexion.php");
    exit;
}
// Permet de supprimer une variable
unset($_SESSION["user"]);
// Pas d'espace entre les : et le Location = ("Location: exemple.php")
header("Location: index.php");
