<?php
include("portsari.php");
include("yhteys.php");

$kysely = $yhteys->prepare("DELETE FROM kommentti WHERE kommentti_id = (?)");
$kysely->execute(array($_POST["kommentti_id"]));

header("Location: uutinen.php?id=" . $_POST["uutis_id"]);
?>