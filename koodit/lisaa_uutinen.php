<?php
include("portsari.php");
include("error.php");
include("yhteys.php");

$pituus = strlen($_POST["otsikko"]);

if ($pituus < 4 || $pituus > 80){
	error("Otsikon sallittu pituus on 4-80 merkkiä.", "uusi_uutinen.php");
}
if (strlen($_POST["leipa"]) < 1){
	error("Uutisessa olisi tarkoitus olla myös leipätekstiä.", "uusi_uutinen.php");
}
$otsikko = htmlspecialchars($_POST["otsikko"]);
$leipa = htmlspecialchars($_POST["leipa"]);

$kysely = $yhteys->prepare("INSERT INTO uutinen (otsikko, leipa, luokka, lisaaja) VALUES (?, ?, ?, ?)");
$kysely->execute(array($otsikko, $leipa, $_POST["luokka"], $_SESSION["login_id"]));

header("Location: index.php"); ?>