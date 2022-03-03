<?php
// On démarre la session PHP
session_start();
$titre = "Accueil";
@include "includes/header.php";
@include "includes/nav.php";
?>

<h2>Accueil</h2>


<?php

@include "includes/footer.php";

?>



<!-- // Utilisation de require_once pour se connecter à la base de données
// require_once "includes/connect.php";

// $username = "admin";
// $password = "azerty";

// Requete SQL
// $sql = "SELECT * FROM `users` WHERE `name`=? AND `password`=?";

// On prépare la requête
// $requete = $db->query($sql);

// On injecte les valeurs "bindValue" (une fonction de pdo)
// Le 1 symbolise le premier "?" de la requete $sql suvie du nom de son champ
// On aurait pu aussi bien écrire à la place du "?" un nom prédédé de : par exemple
// $sql = "SELECT * FROM `users` WHERE `name`=:username AND `password`=:password";
// Il aurait fallu écrire pareil dans la fonction bindValue (":username", $name, PDO::PARAM_STR);
// Sans oublier de les échapper avec des " "
// PDO::PARAM_STR pour dire que c'est une chaine de caractère un STRing
// $requete->bindValue(1, $name, PDO::PARAM_STR);
// $requete->bindValue(2, $password, PDO::PARAM_STR);

// // Ensuite on exécute la requête
// $requete->execute();

// $user = $requete->fetchAll();

// echo "<pre>";
// var_dump($user);
// echo "</pre>";

// @include "includes/footer.php";
//  -->