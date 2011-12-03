<?php
include("yhteys.php");
include("error.php");

$kysely = $yhteys->prepare("SELECT * FROM luokka ORDER BY nimi");
$kysely->execute();
if ($kysely->rowCount() < 1){
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
setlocale(LC_TIME, "fi_FI");
if (isset($_GET["luokka"])){
	$luokka = $_GET["luokka"];
	if ($luokka == 0){
		$kysely = $yhteys->prepare("SELECT uutis_id, otsikko, lisaysaika FROM uutinen ORDER BY lisaysaika DESC");
		$kysely->execute();
	} else {
		$kysely = $yhteys->prepare("SELECT uutis_id, otsikko, lisaysaika FROM uutinen WHERE luokka = (?) ORDER BY lisaysaika DESC");
		$kysely->execute(array($luokka));
	}
	$uutiset = $kysely->rowCount();
	if ($uutiset == 0) echo("Tässä kategoriassa ei ole yhtään uutista.");
	echo("<ul>");
	while ($rivi = $kysely->fetch()){
		$uutiset++;
		echo('<li><a href="uutinen.php?id=' . $rivi["uutis_id"] . '">' . $rivi["otsikko"] . '</a> ' . strftime("%c", strtotime($rivi["lisaysaika"])) . '</li>');
	}
	echo("</ul>");	
}
include("ala.php"); ?>
