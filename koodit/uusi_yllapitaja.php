<?php
include("portsari.php");
include("yla.php");
?>
	<form action="lisaa_yllapitaja.php" method="post">
		<p>Käyttäjätunnus: <br />
		<input type="text" name="nimi" required></p>
		<p>Salasana (min. 4 merkkiä): <br />
		<input type="password" name="passu1" required></p>
		<p>Salasana uudelleen: <br />
		<input type="password" name="passu2" required></p>
		<input type="submit" value="Lisää ylläpitäjä">
	</form>
	
<?php include("ala.php"); ?>