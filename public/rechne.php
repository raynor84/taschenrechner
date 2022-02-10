<?php
	require_once __DIR__ . '/../vendor/autoload.php';
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Klammer;
	use Taschenrechner\Classes\Operationen\KlammerZu;
	use Taschenrechner\Classes\Operationen\Wurzel;
	use Taschenrechner\Classes\Operationen\Tan;
	use Taschenrechner\Classes\Operationen\Cosinus;
	use Taschenrechner\Classes\Operationen\Sinus;
	use Taschenrechner\Classes\Operationen\Potenz;
	use Taschenrechner\Classes\Operationen\Multiplikation;
	use Taschenrechner\Classes\Operationen\Division;
	use Taschenrechner\Classes\Operationen\Addition;
	use Taschenrechner\Classes\Operationen\Subtraktion;
	use Taschenrechner\Classes\Concatinator;

	session_start();
	unset($_SESSION["exception"]);
	unset($_SESSION["ergebnis"]);
	unset($_SESSION["term"]);
	$term = $_GET["term"];
	
	try {
		//Initialisiere den Taschenrechner
		$calculator = new Calculator();
		
		//Füge Operationen hinzu:
		//Deklariere einen Term und übergebe den Term
		
		$calculator->addOperation(5, new Klammer($calculator, new Concatinator()));
		$calculator->addOperation(0, new KlammerZu($calculator, new Concatinator()));
		$calculator->addOperation(4, new Tan($calculator, new Concatinator()));
		$calculator->addOperation(4, new Cosinus($calculator, new Concatinator()));
		$calculator->addOperation(4, new Sinus($calculator, new Concatinator()));
		$calculator->addOperation(3, new Wurzel($calculator, new Concatinator()));
		$calculator->addOperation(3, new Potenz($calculator, new Concatinator()));
		$calculator->addOperation(2, new Multiplikation($calculator, new Concatinator()));
		$calculator->addOperation(2, new Division($calculator, new Concatinator()));
		$calculator->addOperation(1, new Addition($calculator, new Concatinator()));
		$calculator->addOperation(1, new Subtraktion($calculator, new Concatinator()));

		
		
		$ergebnis = $calculator->calculate($term);
		//Sende das Ergebnis zurück zu Index.php
		
		$_SESSION["ergebnis"] = $ergebnis;
		$_SESSION["term"] = $term;
		
		header("Location: index.php");
	
	} catch(Exception $exception) {

		//Sende den Fehler zurück zur Index.php
		$_SESSION["exception"] = $exception->getMessage();
			
	}
	$_SESSION["term"] = $term;


	header("Location: index.php");
?>
