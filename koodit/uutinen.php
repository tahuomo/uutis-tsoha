<?php
include("error.php");
include("yhteys.php");

if ($_GET["id"] == null){
	header("Location: index.php");
	die();
}
setlocale(LC_TIME, "fi_FI");

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

<div id=article>
	<div class="tiedot">
<?php if ($tulos["muokkausaika"] != null ): ?>
	<div style="float: right;">
		Muokkausaika: <?php echo(strftime("%c", strtotime($tulos["muokkausaika"]))); ?><br />
		Muokkaussyy: <?php echo($tulos["muokkaussyy"]); ?>
	</div>
<?php endif; ?>
	Lisääjä: <?php echo($lisaaja["kayttajanimi"]); ?><br />
	Lisäysaika: <?php echo(strftime("%c", strtotime($tulos["lisaysaika"]))); ?>
	</div>
	<hr />
<?php if (isset($_SESSION["login_id"])): ?>
	<form action="muokkaa.php?id=<?php echo($_GET["id"]);?>" method="post" style="float: right;">
		<input type="hidden" name="uutis_id" value="<?php echo($tulos["uutis_id"]);?>" />
		<input type="submit" value="Muokkaa">
	</form>
<?php endif; ?>
		<h2><?php echo($tulos["otsikko"]);?></h2>
		<p class="leipa">
		<?php echo($tulos["leipa"]);?>
		</p>
</div>

<?php 
include("kommentit.php");
kommentit($_GET["id"]);
include("ala.php");?>