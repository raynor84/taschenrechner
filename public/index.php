<?php
	session_start();
?>
<html>
	<head>
		<title>Taschenrechner</title>
		
	</head>
	<body>
		<form action="rechne.php" method="GET">
			<input type="text" name="term" value="<?php if(array_key_exists("term", $_SESSION)) {echo $_SESSION["term"];} ?>">
			<input type="submit" name="berechnen" value="=" />
		</form>
		<?php
			//wurde eine Exception geworfen, dann gebe Sie hier aus
			if(array_key_exists("exception", $_SESSION)) {
				echo "<p>".$_SESSION["exception"]."</p>";
			}
			//wurde ein Ergebnis berechnet, dann gebe Sie hier aus
			if(array_key_exists("ergebnis", $_SESSION)) {
				echo "<p> Das Ergebnis lautet: ".$_SESSION["ergebnis"]."</p>";
			}
		?>
	</body>
</html>
