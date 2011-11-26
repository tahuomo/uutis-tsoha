<?php
include("error.php");
include("yhteys.php");

if ($_GET["id"] == null){
	header("Location: index.php");
	die();
}

$kysely = $yhteys->prepare("SELECT * FROM uutinen WHERE uutis_id = (?)");
$kysely->execute(array($_GET["id"]));
$tulos = $kysely->fetch();

if ($tulos == null){
	error("Antamallasi id:llä ei löydy uutisia." , "selaa.php");
}

$kysely = $yhteys->prepare("SELECT kayttajanimi FROM yllapitaja WHERE yllapitaja_id = (?)");
$kysely->execute(array($tulos["lisaaja"]));
$lisaaja = $kysely->fetch();

include("yla.php");
?>

<article>
	<div class="tiedot">
		Lisääjä: <?php echo($lisaaja["kayttajanimi"]); ?><br />
		Lisäysaika: <?php echo($tulos["lisaysaika"]); ?>
	
<?php
if (isset($_SESSION["login_id"])){
	echo('<form action="muokkaa_uutinen.php" method="post" style="float: right;">');
	echo('<input type="hidden" name="uutis_id" value="' . $tulos["uutis_id"] . '" />');
	echo('<input type="submit" value="Muokkaa">');
	echo('</form>');
}
?>
	</div>
		<hr />
		<h2><?php echo($tulos["otsikko"]);?></h2>
		<p class="leipa">
			<?php echo($tulos["leipa"]);?>
		</p>
	
<?php
if ($tulos["muokkausaika"] != null ){
	echo('<div class="tiedot">');
	echo('Muokkausaika:' . $tulos["muokkausaika"]);
	echo('Muokkaussyy:'. $tulos["muokkaussyy"]);
	echo('</div>');
}
?>
</article>
<?php
//Kommenttien tulostus ja lisäyskaavake
$kysely = $yhteys->prepare("SELECT * FROM kommentti WHERE uutis_id = (?) ORDER BY kommentti_id");
$kysely->execute(array($_GET["id"]));
?>

<p>
Kommentit:
<?php
while ($kommentti = $kysely->fetch()){
	echo('<div class="kommentti">');
	echo('<div class="tiedot">');
	echo($kommentti["nimimerkki"]);
	echo('</div>');
	if (isset($_SESSION["login_id"])){
		echo('<form action="poista_kommentti.php" method="post" style="float: right;">');
		echo('<input type="hidden" name="kommentti_id" value="' . $kommentti["kommentti_id"] . '"/>');
		echo('<input type="hidden" name="uutis_id" value="' . $tulos["uutis_id"] . '"/>');
		echo('<input type="submit" value="Poista">');
		echo('</form>');
	}
	echo("<br />");
	echo($kommentti["teksti"]);
	
	echo("</div>");
} ?>
</p>
<form action="kommentoi.php" method="post">
		<p>Nimimerkki: <br />
			<input type="text" name="nimimerkki">
		</p>
		<p>Kommentti: <br />
			<textarea name="kommentti" cols="25" rows="10" style="width: 400px;"></textarea>
		</p>
		<input type="hidden" name="uutis_id" value="<?php echo($tulos["uutis_id"]); ?>" />
		<input type="submit" value="Lähetä">	
</form>
<?php include("ala.php");?>