<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

require_once(dirname(__FILE__)."/../vendor/autoload.php");
require_once(dirname(__FILE__)."/../operation.php");
require_once(dirname(__FILE__)."/../calculator.php");
require_once(dirname(__FILE__)."/../addition.php");
final class Init
{
    public function calculator() {
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

        return $calculator;
    }   
}