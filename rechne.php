<?php
	require_once("calculator.php");
	
	try {
		$term = $_GET["term"];
		//Initialisiere den Taschenrechner
		$calculator = new Calculator();
		$ergebnis = $calculator->calculate($term);
		//Sende das Ergebnis zurück zu Index.php
		
		
		header("Location: index.php?ergebnis=".urlencode($ergebnis)."&term=".urlencode($term));
	
	} catch(Exception $exception) {

		//Sende den Fehler zurück zur Index.php
		
		header("Location: index.php?exception=".urlencode($exception->getMessage())."&term=".urlencode($term));
			
	}
?>
