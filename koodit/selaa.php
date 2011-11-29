<?php
include("yhteys.php");

$kysely = $yhteys->prepare("SELECT * FROM luokka ORDER BY nimi");
$kysely->execute();
if (empty($kysely)){
	error("Et voi selata uutisia, sillä kategorioita ja siten uutisia ei vielä ole.", "index.php");
}
include("yla.php");
?>

<form action="selaa.php" method="GET">
		<p>Kategoria:
		<select name="luokka">
			<option value="0">*</option>
			<?php while($rivi = $kysely->fetch()) 
			echo('<option value="'. $rivi["luokka_id"] . '">' . $rivi["nimi"] . "</option>"); ?>	
		</select>
		<input type="submit" value="Valitse"></p>
</form>

<?php
if (isset($_GET["luokka"])){
	echo("<ul>");
	$luokka = $_GET["luokka"];
	if ($luokka == 0){
		$kysely = $yhteys->prepare("SELECT uutis_id, otsikko, lisaysaika FROM uutinen ORDER BY lisaysaika DESC");
		$kysely->execute();
	} else {
		$kysely = $yhteys->prepare("SELECT uutis_id, otsikko, lisaysaika FROM uutinen WHERE luokka = (?) ORDER BY lisaysaika DESC");
		$kysely->execute(array($luokka));
	}
	$uutiset = 0;
	while ($rivi = $kysely->fetch()){
		$uutiset++;
		echo('<li><a href="uutinen.php?id=' . $rivi["uutis_id"] . '">' . $rivi["otsikko"] . '</a> ' . $rivi["lisaysaika"] . '</li>');
	}
	echo("</ul>");
	if ($uutiset == 0) echo("Tässä kategoriassa ei ole yhtään uutista.");
}

include("ala.php"); ?>
