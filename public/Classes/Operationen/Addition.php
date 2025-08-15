<?php
    namespace Taschenrechner\Classes\Operationen;
	use Taschenrechner\Classes\ICalculator;
	class Addition extends Operation {
		public function getSign() {
			return "+";
		}	
		
		public function calculate($a,$b=NULL) {
			return $a + $b;
		}
		public function findAndCalculateTerm(ICalculator $calculator) {
		    
		    return (new einfacheOperation())->findAndCalculateTerm($calculator, $this);
		}
		
	}

?>
