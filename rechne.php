<?php
	require_once("calculator.php");
	
	try {
		$term = $_GET["term"];
		//Initialisiere den Taschenrechner
		$calculator = new Calculator();
		
		//Füge Operationen hinzu:
		//Deklariere einen Term und übergebe den Term
		$calculator->addOperation(4, new Klammer($calculator, new Numeric()));
		$calculator->addOperation(4, new KlammerZu($calculator, new Numeric()));
		$calculator->addOperation(3, new Wurzel($calculator, new Numeric()));
		$calculator->addOperation(3, new Potenz($calculator, new Numeric()));
		$calculator->addOperation(2, new Multiplikation($calculator, new Numeric()));
		$calculator->addOperation(2, new Division($calculator, new Numeric()));
		$calculator->addOperation(1, new Addition($calculator, new Numeric()));
		$calculator->addOperation(1, new Subtraktion($calculator, new Numeric()));
		
		
		$ergebnis = $calculator->calculate($term);
		//Sende das Ergebnis zurück zu Index.php
		
		
		header("Location: index.php?ergebnis=".urlencode($ergebnis)."&term=".urlencode($term));
	
	} catch(Exception $exception) {

		//Sende den Fehler zurück zur Index.php
		
		header("Location: index.php?exception=".urlencode($exception->getMessage())."&term=".urlencode($term));
			
	}
?>
