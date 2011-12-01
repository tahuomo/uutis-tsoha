<?php
include("portsari.php");
include("error.php");
include("yhteys.php");

$kysely = $yhteys->prepare("SELECT count(*) FROM luokka");
$kysely->execute();
$tulos = $kysely->fetch();
if ($tulos[0] < 1){
	error("Et voi vielä lisätä uutisia, sillä ei ole olemassa yhtään kategoriaa.", "index.php");
}
include("yla.php");

$kysely = $yhteys->prepare("SELECT * FROM luokka ORDER BY nimi");
$kysely->execute();
?>

<form action="lisaa_uutinen.php" method="post">
	<p>Otsikko: <br />
	<input type="text" name="otsikko" style="width: 600px"></p>
	<p>Kategoria: <br />
	<select name="luokka">
	<?php while($rivi = $kysely->fetch()) echo('<option value="'. $rivi["luokka_id"] . '">' . $rivi["nimi"] . "</option>"); ?>	
	</select></p>
	<p>Leipäteksti: <br />
	<textarea name="leipa" cols="25" rows="25" style="width: 600px"></textarea>
	<br />(Huom! HTML-koodi tai linkit uutisessa eivät toimi.)</p>
	<input type="submit" value="Lisää uutinen">
</form>

<?php include("ala.php");?>