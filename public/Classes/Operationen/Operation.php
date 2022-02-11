<?php
    namespace Taschenrechner\Classes\Operationen;
    use Taschenrechner\Classes\Calculator;
    use Taschenrechner\Classes\Concatinator;

	//Abstrakte Klasse Operation
	abstract class Operation {
    	protected $calculator;
    	public function __construct(Calculator $calculator, Concatinator $concatinator) {
        	$this->calculator = $calculator;
        	$this->concatinator = $concatinator;
    	}
		//Gibt Operanten zurück
		abstract public function getSign();
		//Berechnet den Term und gibt den neuen Term zurück
		abstract public function calculate($a, $b=NULL);
		public function findAndCalculateTerm($split_term, $operations) {
			
			//arbeitet intern mit dem Array
			$array = $split_term;
			
			for($i =0; $i < sizeof($array)-1; $i++) {
				//Suche nach der Operation
				if($array[$i]===$this->getSign()) {
					$a= array_key_exists($i-1,$array) ? $array[$i-1]:NULL;
					$b= array_key_exists($i+1,$array) ? $array[$i+1]:NULL;
					
					if(!is_numeric($array[$i+1])) {
						throw new \Exception("Bitte einen gültigen Term eingeben");
					}
					//Berechne die Operation
					$array[$i-1] = $this->calculate($a, $b);
					
					//Lösche die Operation und den 2. Term vom Array
					unset($array[$i]);
					unset($array[$i+1]);
					$array = array_values($array);

					return $array;
					
				}

			}
			if(sizeof($array)>0)
				return $array;
			else 
				return array(0);
			
		}
	}
?>
