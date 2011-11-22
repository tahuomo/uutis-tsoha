<?php
session_start();

include("yhteys.php");
include("error.php");

$tunnus  = htmlspecialchars($_POST["tunnus"]);
$salasana  = htmlspecialchars($_POST["salasana"]);
$salasana = md5($salasana . "virtahepo");

$kysely = $yhteys->prepare("SELECT * FROM yllapitaja WHERE kayttajanimi = (?) AND salasana = (?)");
$kysely->execute(array($tunnus, $salasana));
$tulos = $kysely->fetch();

if ($tulos == NULL){
	error("Käyttäjätunnus tai salasana väärin", "kirjaudu.php");
}

$_SESSION["login_id"] = $tulos["yllapitaja_id"];

header("Location: index.php");
?>