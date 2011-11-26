<?php 
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

include("yla.php");?>

<ul>
	<li>Uutisia: <?php echo($uutiset[0]) ?></li>
	<li>Kategorioita:  <?php echo($luokat[0]) ?></li>
	<li>Kommentteja: <?php echo($kommentit[0]) ?></li>
	<li>Ylläpitäjiä:<?php echo($yllapitajat[0]) ?></li>
</ul>

<?php include("ala.php"); ?>
