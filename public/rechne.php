<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Klammer;
	use Taschenrechner\Classes\KlammerZu;
	use Taschenrechner\Classes\Wurzel;
	use Taschenrechner\Classes\Potenz;
	use Taschenrechner\Classes\Multiplikation;
	use Taschenrechner\Classes\Division;
	use Taschenrechner\Classes\Addition;
	use Taschenrechner\Classes\Subtraktion;
	use Taschenrechner\Classes\Numeric;


	
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
