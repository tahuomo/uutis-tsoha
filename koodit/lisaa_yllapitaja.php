<?php
include("portsari.php");
include("error.php");
include("yhteys.php");

if (( strlen(trim($_POST["nimi"])) < 2) || (strlen($_POST["nimi"]) > 30) ){
	error("Käyttäjätunnuksen sallittu pituus on 2-30 merkkiä.", "uusi_yllapitaja.php");
}
if (strlen($_POST["passu1"]) < 4){
	error("Salasanan on oltava vähintään 4 merkkiä pitkä.", "uusi_yllapitaja.php");	
}
if (strcmp($_POST["passu1"], $_POST["passu2"]) != 0){
	error("Antamasi salasanat eivät täsmää.", "uusi_yllapitaja.php");	
}
$salattu = md5($_POST["passu1"] . "virtahepo");
$nimi = htmlspecialchars(trim($_POST["nimi"]));
$kysely = $yhteys->prepare("INSERT INTO yllapitaja (kayttajanimi, salasana) VALUES (?, ?)");
try {
    $kysely->execute(array($nimi, $salattu));
} catch (PDOException $e) {
    error("Käyttäjätunnus on jo varattu.", "uusi_yllapitaja.php");
}
include("yla.php");?>

<p>Uusi ylläpitäjä lisätty nimellä "<?php echo($nimi); ?>"</p>
<?php include("ala.php"); ?>