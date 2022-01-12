<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Klammer;
	use Taschenrechner\Classes\Operationen\KlammerZu;
	use Taschenrechner\Classes\Operationen\Wurzel;
	use Taschenrechner\Classes\Operationen\Potenz;
	use Taschenrechner\Classes\Operationen\Multiplikation;
	use Taschenrechner\Classes\Operationen\Division;
	use Taschenrechner\Classes\Operationen\Addition;
	use Taschenrechner\Classes\Operationen\Subtraktion;
	use Taschenrechner\Classes\Concatinator;


final class Init
{
    public function calculator() {
		$calculator = new Calculator();
		
		//Füge Operationen hinzu:
		//Deklariere einen Term und übergebe den Term
		$calculator->addOperation(4, new Klammer($calculator, new Concatinator()));
		$calculator->addOperation(4, new KlammerZu($calculator, new Concatinator()));
		$calculator->addOperation(3, new Wurzel($calculator, new Concatinator()));
		$calculator->addOperation(3, new Potenz($calculator, new Concatinator()));
		$calculator->addOperation(2, new Multiplikation($calculator, new Concatinator()));
		$calculator->addOperation(2, new Division($calculator, new Concatinator()));
		$calculator->addOperation(1, new Addition($calculator, new Concatinator()));
		$calculator->addOperation(1, new Subtraktion($calculator, new Concatinator()));

        return $calculator;
    }   
}