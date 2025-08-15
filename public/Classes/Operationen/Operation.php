<?php
    namespace Taschenrechner\Classes\Operationen;
    use Taschenrechner\Classes\Calculator;
    use Taschenrechner\Classes\ICalculator;
    use Taschenrechner\Classes\Concatinator;

	//Abstrakte Klasse Operation
	abstract class Operation {
    	protected $calculator;
    	public function __construct(Calculator $calculator) {
        	$this->calculator = $calculator;
    	}
		//Gibt Operanten zurück
		abstract public function getSign();
		//Berechnet den Term und gibt den neuen Term zurück
		abstract public function calculate($a, $b=NULL);
		abstract public function findAndCalculateTerm(ICalculator $calculator);
	}
?>
