<?php
include("error.php");
include("yhteys.php");

if (strlen($_POST["nimi"]) < 2 ) {
	error("Kategorian nimessä on oltava väh. kaksi merkkiä.", "uusi_luokka.php");
}

$nimi = htmlspecialchars($_POST["nimi"]);
$kysely = $yhteys->prepare("INSERT INTO luokka (nimi) VALUES (?)");
try {
    $kysely->execute(array($nimi));
} catch (PDOException $e) {
    error("Luokka on jo olemassa.", "uusi_luokka.php");
}
include("yla.php");
echo("<p>Uusi luokka lisätty nimellä " . $nimi . "</p>");
include("ala.php");
?>