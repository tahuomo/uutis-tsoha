<?php
function error($virheteksti, $linkki){
   include("yla.php");
	echo("<p>$virheteksti</p>");
	echo("<p><a href=\"" . $linkki . "\">Takaisin</a></p>");
	include("ala.php");
	die();
}
?>