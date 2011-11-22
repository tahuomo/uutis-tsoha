<?php include("yla.php");

include("yhteys.php");

$kysely = $yhteys->prepare("SELECT count(*) FROM uutinen");
$kysely->execute();

$uutiset = $kysely->fetch();

$kysely = $yhteys->prepare("SELECT count(*) FROM luokka");
$kysely->execute();

$luokat = $kysely->fetch();

$kysely = $yhteys->prepare("SELECT count(*) FROM kommentti");
$kysely->execute();

$kommentit = $kysely->fetch();

$kysely = $yhteys->prepare("SELECT count(*) FROM yllapitaja");
$kysely->execute();

$yllapitajat = $kysely->fetch();

echo("<p>");
echo("Uutisia on tietokannassa " . $uutiset[0] . " kpl. ");
echo("Ne on jaettu " . $luokat[0] . " kategoriaan, ");
echo("ja niitä on kommentoitu " . $kommentit[0] . " kertaa.");
echo("<br /><br />");
echo("Ylläpitäjiä löytyy " . $yllapitajat[0] . " kpl.");
echo("</p>");

include("ala.php"); ?>
