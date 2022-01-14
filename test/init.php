<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
	use Taschenrechner\Classes\Calculator;
	use Taschenrechner\Classes\Operationen\Tan;
	use Taschenrechner\Classes\Operationen\Cosinus;
	use Taschenrechner\Classes\Operationen\Sinus;
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
	private $operations = array();
	public function __construct() {
		$calculator = new Calculator();
		//Füge Operationen hinzu:
		//Deklariere einen Term und übergebe den Term
		array_push($this->operations, array(0=>5, "object"=>new Klammer($calculator, new Concatinator())));
		array_push($this->operations, array(0=>0, "object"=>new KlammerZu($calculator, new Concatinator())));
		array_push($this->operations, array(0=>4, "object"=>new Tan($calculator, new Concatinator())));
		array_push($this->operations, array(0=>4, "object"=>new Cosinus($calculator, new Concatinator())));
		array_push($this->operations, array(0=>4, "object"=>new Sinus($calculator, new Concatinator())));
		array_push($this->operations, array(0=>3, "object"=>new Wurzel($calculator, new Concatinator())));
		array_push($this->operations, array(0=>3, "object"=>new Potenz($calculator, new Concatinator())));
		array_push($this->operations, array(0=>2, "object"=>new Multiplikation($calculator, new Concatinator())));
		array_push($this->operations, array(0=>2, "object"=>new Division($calculator, new Concatinator())));
		array_push($this->operations, array(0=>1, "object"=>new Addition($calculator, new Concatinator())));
		array_push($this->operations, array(0=>1, "object"=>new Subtraktion($calculator, new Concatinator())));
	}

    public function calculator() {
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

        return $calculator;
    } 
	
	public function operations() {
		return $this->operations;
	}
}