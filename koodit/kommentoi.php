<?php
include("error.php");
include("yhteys.php");

$takaisin = "uutinen.php?id=" . $_POST["uutis_id"];
$kommentti = htmlspecialchars($_POST["kommentti"]);
$nimimerkki = htmlspecialchars($_POST["nimimerkki"]);

if (strlen(trim($kommentti)) < 3){
	error("Kommentin on oltava vähintään 3 merkkiä pitkä.", $takaisin);
}

if (strlen($nimimerkki) > 30){
	error("Nimimerkin pituus max. 30 merkkiä.", $takaisin);
}

if (strlen(trim($nimimerkki)) < 1){
	$kysely = $yhteys->prepare("INSERT INTO kommentti (teksti, uutis_id) VALUES (?, ?)");
	$kysely->execute(array($kommentti, $_POST["uutis_id"]));
} else {
	$kysely = $yhteys->prepare("INSERT INTO kommentti (nimimerkki, teksti, uutis_id) VALUES (?, ?, ?)");
	$kysely->execute(array($nimimerkki, $kommentti, $_POST["uutis_id"]));
}

header("Location: " . $takaisin); ?>