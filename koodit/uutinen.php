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
<?php
if ($tulos["muokkausaika"] != null ){
	echo('<div style="float: right;">');
	echo('Muokkausaika: ' . $tulos["muokkausaika"]);
	echo('<br />Muokkaussyy: '. $tulos["muokkaussyy"]);
	echo('</div>');
}
?>
	Lisääjä: <?php echo($lisaaja["kayttajanimi"]); ?><br />
	Lisäysaika: <?php echo($tulos["lisaysaika"]); ?>
	</div>
	<hr />
<?php 
	if (isset($_SESSION["login_id"])){
		echo('<form action="muokkaa.php?id=' . $_GET["id"] . '" method="post" style="float: right;">');
		echo('<input type="hidden" name="uutis_id" value="' . $tulos["uutis_id"] . '" />');
		echo('<input type="submit" value="Muokkaa">');
		echo('</form>');
	}
?>
		<h2><?php echo($tulos["otsikko"]);?></h2>
		<p class="leipa">
		<?php echo($tulos["leipa"]);?>
		</p>
</article>

<?php 
include("kommentit.php");
include("ala.php");?>