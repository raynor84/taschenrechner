<?php
    namespace Taschenrechner\Classes\Operationen;
    use Taschenrechner\Classes\ICalculator;
    
	class Potenz extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "^";
		}	
		
		public function calculate($a, $b=NULL) {
			return pow($a,$b);
		}
		public function findAndCalculateTerm(ICalculator $calculator) {
		    return (new einfacheOperation())->findAndCalculateTerm($calculator, $this);
		}
	}
?>
