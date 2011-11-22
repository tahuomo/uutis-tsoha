<?php 
session_start();
if (!isset($_SESSION["login_id"])) {
    header("Location: kirjaudu.php");
    die();
}

include("yla.php"); ?>

<form action="lisaa_luokka.php" method="post">
		<p>Kategorian nimi: <br />
		<input type="text" name="nimi"></p>
		<input type="submit" value="Lisää kategoria">
</form>


<?php 
include("yhteys.php");

$kysely = $yhteys->prepare("SELECT nimi FROM luokka order by nimi");
$kysely->execute();

// Kerrotaan käyttäjälle jo olemassa olevat luokat
echo("<p>Olemassa olevat kategoriat:");
echo("<ul>");
while ($rivi = $kysely->fetch()) {
    echo ("<li>" . $rivi["nimi"] . "</li>");
}
echo("</ul></p>");
include("ala.php"); 
 
 ?>