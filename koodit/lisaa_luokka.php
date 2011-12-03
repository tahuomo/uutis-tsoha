<?php
include("portsari.php");
include("error.php");
include("yhteys.php");

if (( strlen(trim($_POST["nimi"])) < 2) || ( strlen($_POST["nimi"]) > 40) ){
	error("Kategorian sallittu pituus on 2-40 merkkiä.", "uusi_luokka.php");
}
$nimi = htmlspecialchars(trim($_POST["nimi"]));
$kysely = $yhteys->prepare("INSERT INTO luokka (nimi) VALUES (?)");

try {
    $kysely->execute(array($nimi));
} catch (PDOException $e) {
    error("Kategoria on jo olemassa.", "uusi_luokka.php");
}
header("Location: uusi_luokka.php") ?>