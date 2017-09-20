<!DOCTYPE html>
<html>
<head>
	<title>PHP-Campus !Error</title>
	<?php include("../essential_settings.php"); Initialize(); ?>
</head>
<body>
	<fieldset class="info">
		<h2>PHP-Campus Error Report</h2>
		<p>PHP-Campus may encounter an error.</p>
		<?php if(isset($_GET["reason"])):?>
			<p>This product automatically redirected visitor to this page purposely.</p>
			<p>With the reason: <b id="bold" style="color: orange;"><?php echo $_GET["reason"];?></b></p>
			<?php if($_GET["reason"]=="Unauthorized Action(UA)"):?>
				<script>document.getElementById("bold").style.color="red";</script>
				<p>Client IP <?php echo $_SERVER["REMOTE_ADDR"];?></p>
				<p>Client location <?php echo $_SESSION["IP_LOCATE"];?></p>
			<?php endif; ?>
		<?php endif; ?>
	</fieldset>

	
</body>
</html>