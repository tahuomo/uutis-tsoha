<?php
//Reverse portsari - ei päästetä kirjautumaan, jos on jo kirjauduttu.
session_start();
if (isset($_SESSION["login_id"])){
	header("Location: index.php");
	die();
}
include("yla.php");
?>

<form action="sisaan.php" method="post">
	<p>Admin-tunnus:<br />
	<input type="text" name="tunnus" required></p>
	<p>Salasana:<br />
	<input type="password" name="salasana" required><p/>
	<input type="submit" value="Kirjaudu">
</form>

<?php include("ala.php"); ?>