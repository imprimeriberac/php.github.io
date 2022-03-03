<?php
session_start();
$titre = $_SESSION["user"]["pseudo"];
@include "includes/header.php";
@include "includes/nav.php";
?>

<h2>Profil de <?= $_SESSION["user"]["pseudo"] ?></h2>

<p>Pseudo : <?= $_SESSION["user"]["pseudo"] ?></p>
<p>Email : <?= $_SESSION["user"]["email"] ?></p>


<?php
@include "includes/footer.php";
