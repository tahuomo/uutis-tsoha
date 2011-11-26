<?php
include("portsari.php");
include("error.php");
include("yhteys.php");
include("yla.php");

if (!isset($_GET["id"])){
	header("Location: index.php");
	die();
}

$kysely = $yhteys->prepare("SELECT * FROM uutinen WHERE uutis_id = (?)");
$kysely->execute(array($_GET["id"]));
$tulos = $kysely->fetch();

if ($tulos == null){
	error("Antamallasi id:llä ei löydy uutisia." , "selaa.php");
}
?>

<form action="talleta_muokkaus.php" method="post">
		<p>Otsikko: <br />
		<input type="text" name="otsikko" value=<?php echo('"'. $tulos["otsikko"] .'"');?> style="width: 600px"></p>
		<p>Kategoria: <br />
		<select name="luokka">
<?php 
	$kysely2 = $yhteys->prepare("SELECT * FROM luokka ORDER BY nimi");
	$kysely2->execute();
	while($rivi = $kysely2->fetch()){
		if ($rivi["luokka_id"] == $tulos["luokka"]){
			echo('<option selected="selected" value="'. $rivi["nimi"] . '">' . $rivi["nimi"] . "</option>");
		} else {
			echo('<option value="'. $rivi["nimi"] . '">' . $rivi["nimi"] . "</option>");
		}
	}
?>	
	</select></p>
	<p>Leipäteksti: <br />
	<textarea name="leipa" cols="25" rows="25" style="width: 600px"><?php echo($tulos["leipa"]);?></textarea>
	<br />(Huom! HTML-koodi tai linkit uutisessa eivät toimi.)</p>
	<p>Muokkaussyy:<br />
	<input type="text" name="syy" style="width: 600px"></p>
	<?php echo('<input type="hidden" name="id" value="' . $_GET["id"] . '">') ?>
	<input type="submit" value="Tallenna muutokset">
</form>

<?php include("ala.php"); ?>
