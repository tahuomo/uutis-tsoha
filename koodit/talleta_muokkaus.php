<?php
include("portsari.php");
include("error.php");
include("yhteys.php");

$pituus = strlen($_POST["otsikko"]);

if ($pituus < 4 || $pituus > 80){
	error("Otsikon sallittu pituus on 4-80 merkkiä.", "muokkaa.php?id=" . $_POST["id"]);
}
if (strlen($_POST["leipa"]) < 1){
	error("Uutisessa olisi tarkoitus olla myös leipätekstiä.", "muokkaa.php?id=" . $_POST["id"]);
}
$otsikko = htmlspecialchars($_POST["otsikko"]);
$leipa = htmlspecialchars($_POST["leipa"]);
$syy = htmlspecialchars($_POST["syy"]);

if (strlen($syy) == 0) $syy = "???";

$kysely = $yhteys->prepare("SELECT luokka_id FROM luokka WHERE nimi = (?)");
$kysely->execute(array($_POST["luokka"]));
$luokka = $kysely->fetch();

$kysely = $yhteys->prepare("UPDATE uutinen SET otsikko = (?), leipa = (?), luokka = (?), muokkaussyy = (?), muokkausaika = now() WHERE uutis_id = (?)");
$kysely->execute(array($otsikko, $leipa, $luokka["luokka_id"], $syy, $_POST["id"]));

header("Location: uutinen.php?id=" . $_POST["id"]); ?>