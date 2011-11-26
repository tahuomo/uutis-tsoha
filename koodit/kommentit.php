<?php
require_once("yhteys.php");
if (!isset($_GET["id"])){
	header("Location: index.php");
	die();
}
$kysely = $yhteys->prepare("SELECT * FROM kommentti WHERE uutis_id = (?) ORDER BY kommentti_id");
$kysely->execute(array($_GET["id"]));
?>

<p>
<?php
if (!empty($kysely)) echo("Kommentit:");
while ($kommentti = $kysely->fetch()){
	echo('<div class="kommentti">');
	echo('<div class="tiedot">');
	echo($kommentti["nimimerkki"]);
	if (isset($_SESSION["login_id"])){
		echo('<form action="poista_kommentti.php" method="post" style="float: right;">');
		echo('<input type="hidden" name="kommentti_id" value="' . $kommentti["kommentti_id"] . '"/>');
		echo('<input type="hidden" name="uutis_id" value="' . $tulos["uutis_id"] . '"/>');
		echo('<input type="submit" value="Poista">');
		echo('</form>');
	}
	echo('</div>');
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
		<input type="submit" value="Kommentoi">	
</form>