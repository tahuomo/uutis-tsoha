<?php include("yla.php"); ?>
	<form action="lisaa_yllapitaja.php" method="post">
		<p>Käyttäjätunnus: <br />
		<input type="text" name="nimi"></p>
		<p>Salasana (min. 4 merkkiä): <br />
		<input type="password" name="passu1"></p>
		<p>Salasana uudelleen: <br />
		<input type="password" name="passu2"></p>
		<input type="submit" value="Lisää ylläpitäjä">
	</form>
	
<?php include("ala.php"); ?>