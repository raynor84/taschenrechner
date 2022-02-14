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
		$concatinator = new Concatinator();
		//Füge Operationen hinzu:
		array_push($this->operations, array(0=>5, "object"=>new Klammer($calculator, $concatinator)));
		array_push($this->operations, array(0=>4, "object"=>new Tan($calculator, $concatinator)));
		array_push($this->operations, array(0=>4, "object"=>new Cosinus($calculator, $concatinator)));
		array_push($this->operations, array(0=>4, "object"=>new Sinus($calculator, $concatinator)));
		array_push($this->operations, array(0=>3, "object"=>new Wurzel($calculator, $concatinator)));
		array_push($this->operations, array(0=>3, "object"=>new Potenz($calculator, $concatinator)));
		array_push($this->operations, array(0=>2, "object"=>new Multiplikation($calculator, $concatinator)));
		array_push($this->operations, array(0=>2, "object"=>new Division($calculator, $concatinator)));
		array_push($this->operations, array(0=>1, "object"=>new Addition($calculator, $concatinator)));
		array_push($this->operations, array(0=>1, "object"=>new Subtraktion($calculator, $concatinator)));
		array_push($this->operations, array(0=>0, "object"=>new KlammerZu($calculator, $concatinator)));
	}

    public function calculator() {
		$calculator = new Calculator();
		$concatinator = new Concatinator();
		//Füge Operationen hinzu:
		$calculator->addOperation(5, new Klammer($calculator, $concatinator));
		$calculator->addOperation(4, new Tan($calculator, $concatinator));
		$calculator->addOperation(4, new Cosinus($calculator, $concatinator));
		$calculator->addOperation(4, new Sinus($calculator, $concatinator));
		$calculator->addOperation(3, new Wurzel($calculator, $concatinator));
		$calculator->addOperation(3, new Potenz($calculator, $concatinator));
		$calculator->addOperation(2, new Multiplikation($calculator, $concatinator));
		$calculator->addOperation(2, new Division($calculator, $concatinator));
		$calculator->addOperation(1, new Addition($calculator, $concatinator));
		$calculator->addOperation(1, new Subtraktion($calculator, $concatinator));
		$calculator->addOperation(0, new KlammerZu($calculator, $concatinator));

        return $calculator;
    } 
	
	public function operations() {
		return $this->operations;
	}
}