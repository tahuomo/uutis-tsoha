<?php
function kommentit($id){
	include("yhteys.php");
	$kysely = $yhteys->prepare("SELECT * FROM kommentti WHERE uutis_id = (?) ORDER BY kommentti_id");
	$kysely->execute(array($id));

	
	if (!empty($kysely)):?>
	<p>
	Kommentit:
	<?php while ($kommentti = $kysely->fetch()): ?>
		<div class="kommentti">
		<div class="kommenttitiedot">
		<?php echo($kommentti["nimimerkki"]);
		if (isset($_SESSION["login_id"])): ?>
				<form action="poista_kommentti.php" method="post" style="float: right;">
				<input type="hidden" name="kommentti_id" value="<?php echo($kommentti["kommentti_id"]);?>"/>
				<input type="hidden" name="uutis_id" value="<?php echo($id); ?>"/>
				<input type="submit" value="Poista">
				</form>
		<?php endif; ?>
		</div>
		<br />
		<?php echo($kommentti["teksti"]); ?>
		</div>
	<?php 
	endwhile;
	endif; ?>
	</p>
	<form action="kommentoi.php" method="post">
			<p>Nimimerkki: <br />
			<input type="text" name="nimimerkki">
			</p>
			<p>Kommentti: <br />
			<textarea name="kommentti" cols="25" rows="10" style="width: 400px;"></textarea>
			</p>
			<input type="hidden" name="uutis_id" value="<?php echo($id); ?>" />
			<input type="submit" value="Kommentoi">	
	</form>
<?php } ?>
