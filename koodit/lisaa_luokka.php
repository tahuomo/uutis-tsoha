<?php
include("portsari.php");
include("error.php");
include("yhteys.php");

$pituus = strlen($_POST["nimi"]);
if (( $pituus < 2) || ( $pituus > 40) ){
	error("Kategorian sallittu pituus on 2-40 merkkiä.", "uusi_luokka.php");
}

$nimi = htmlspecialchars($_POST["nimi"]);
$kysely = $yhteys->prepare("INSERT INTO luokka (nimi) VALUES (?)");
try {
    $kysely->execute(array($nimi));
} catch (PDOException $e) {
    error("Kategoria on jo olemassa.", "uusi_luokka.php");
}
header("Location: uusi_luokka.php") ?>