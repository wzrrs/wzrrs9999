<?php

try {

    $bdd = new PDO('mysql:host=localhost;dbname=u760877908_bryss;charset=utf8', 'u760877908_bryss', '369adnGAETAN');
    $bdd->exec("set names utf8");
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exeption $e) {
    die('Erreur : ' . $e->getMessage());
}
?>
