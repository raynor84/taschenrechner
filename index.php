<html>
	<head>
		<title>Taschenrechner</title>
		
	</head>
	<body>
		<form action="rechne.php" method="GET">
			<input type="text" name="term" value="<?php if(array_key_exists("term", $_GET)) {echo $_GET["term"];} ?>">
			<input type="submit" name="berechnen" value="=" />
		</form>
		<?php
			//wurde eine Exception geworfen, dann gebe Sie hier aus
			if(array_key_exists("exception", $_GET)) {
				echo "<p>".$_GET["exception"]."</p>";
			}
			//wurde ein Ergebnis berechnet, dann gebe Sie hier aus
			if(array_key_exists("ergebnis", $_GET)) {
				echo "<p> Das Ergebnis lautet: ".$_GET["ergebnis"]."</p>";
			}
		?>
	</body>
</html>