<?php
session_start(); ?>

<!doctype html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>Uutistietokanta</title>
		<link rel="stylesheet" href="tyyli.css" type="text/css" />
	</head>
	
	<body>
		<h1>Uutistietokanta</h1>
		<nav>
			<a href="index.php">Etusivu</a>
			<a href="selaa.php">Selaa uutisia</a>
			
<?php

if (!isset($_SESSION["login_id"])){
	echo("<a href=\"kirjaudu.php\">Kirjaudu sisään</a>");
} else {
	echo(" <a href=\"uusi_yllapitaja.php\">Lisää ylläpitäjä</a>");
	echo(" <a href=\"uusi_luokka.php\">Lisää kategoria</a>");
	echo(" <a href=\"uusi_uutinen.php\">Lisää uutinen</a>");
	echo(" <a href=\"ulos.php\">Kirjaudu ulos</a>");
}
echo("</nav>");

?>