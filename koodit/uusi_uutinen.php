<?php
session_start();
if (!isset($_SESSION["login_id"])) {
    header("Location: kirjaudu.php");
    die();
}
include("error.php");
include("yhteys.php");

$kysely = $yhteys->prepare("SELECT count(*) FROM luokka");
$kysely->execute();

$tulos = $kysely->fetch();
if ($tulos[0] < 1){
	error("Et voi lisätä vielä uutisia, sillä ei ole olemassa yhtään kategoriaa.", "index.php");
}

$kysely = $yhteys->prepare("SELECT nimi FROM luokka ORDER BY nimi");
$kysely->execute();

include("yla.php");
?>

<form action="lisaa_uutinen.php" method="post">
		<p>Otsikko: <br />
		<input type="text" name="otsikko" style="width: 25%"></p>
		<p>Kategoria: <br />
		<select name="luokka">
<?php 
	while($rivi = $kysely->fetch()){
	 echo('<option value=\"'. $rivi["nimi"] . '\">' . $rivi["nimi"] . "</option>");
	}
?>	
	</select></p>
	<p>Leipäteksti: <br />
	<textarea name="post_text" cols="25" rows="25" style="width: 40%"></textarea></p>
	<input type="submit" value="Lisää uutinen">
</form>

<?php include("ala.php");?>