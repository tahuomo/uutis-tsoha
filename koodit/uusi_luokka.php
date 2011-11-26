<?php 
include("portsari.php");
include("yla.php"); 
include("yhteys.php");

$kysely = $yhteys->prepare("SELECT nimi FROM luokka order by nimi");
$kysely->execute();
?>

<form action="lisaa_luokka.php" method="post">
		<p>Kategorian nimi: <br />
		<input type="text" name="nimi"></p>
		<input type="submit" value="Lisää kategoria">
</form>

<p>Nykyiset kategoriat:
<?php if (!isset($kysely)) echo("Kategorioita ei ole vielä olemassa."); ?>
	<ul>
	<?php while ($rivi = $kysely->fetch()) echo ("<li>" . $rivi["nimi"] . "</li>"); ?>
	</ul>
</p>
<?php include("ala.php"); ?>