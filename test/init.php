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
		//Deklariere einen Term und übergebe den Term
		array_push($this->operations, array(0=>5, "object"=>new Klammer($calculator)));
		array_push($this->operations, array(0=>0, "object"=>new KlammerZu($calculator)));
		array_push($this->operations, array(0=>4, "object"=>new Tan($calculator)));
		array_push($this->operations, array(0=>4, "object"=>new Cosinus($calculator)));
		array_push($this->operations, array(0=>4, "object"=>new Sinus($calculator)));
		array_push($this->operations, array(0=>3, "object"=>new Wurzel($calculator)));
		array_push($this->operations, array(0=>3, "object"=>new Potenz($calculator)));
		array_push($this->operations, array(0=>2, "object"=>new Multiplikation($calculator)));
		array_push($this->operations, array(0=>2, "object"=>new Division($calculator)));
		array_push($this->operations, array(0=>1, "object"=>new Addition($calculator)));
		array_push($this->operations, array(0=>1, "object"=>new Subtraktion($calculator)));
	}

    public function calculator() {
		$calculator = new Calculator();
		$concatinator = new Concatinator();
		//Füge Operationen hinzu:
		//Deklariere einen Term und übergebe den Term
		$calculator->addOperation(5, new Klammer($calculator));
		$calculator->addOperation(0, new KlammerZu($calculator));
		$calculator->addOperation(4, new Tan($calculator));
		$calculator->addOperation(4, new Cosinus($calculator));
		$calculator->addOperation(4, new Sinus($calculator));
		$calculator->addOperation(3, new Wurzel($calculator));
		$calculator->addOperation(3, new Potenz($calculator));
		$calculator->addOperation(2, new Multiplikation($calculator));
		$calculator->addOperation(2, new Division($calculator));
		$calculator->addOperation(1, new Addition($calculator));
		$calculator->addOperation(1, new Subtraktion($calculator));


        return $calculator;
    } 
	
	public function operations() {
		return $this->operations;
	}
}