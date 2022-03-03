<?php
//Constantes d'environnement
define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "root");
define("DBNAME", "tuto_php");

// DSN (dsn=data_source_name) de connexion pour PDO (pdo=php_data_object)
$dsn = "mysql:dbname=" . DBNAME . ";host=" . DBHOST;

// Connexion à la base de donnée

try {
    // Instancier PDO
    $db = new PDO($dsn, DBUSER, DBPASS);
    // echo "On est connectés !";
    // On s'assure d'envoyer les données en UTF-8
    $db->exec("SET NAMES utf8");
    // On définit le mode de "fetch" par défaut
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erreur:" . $e->getMessage());
}
