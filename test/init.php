<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
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