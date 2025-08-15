<?php
    namespace Taschenrechner\Classes\Operationen;
    use Taschenrechner\Classes\ICalculator;
    
	class Wurzel extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "√";
		}	
		
		public function calculate($a, $b=NULL) {
			if($a==NULL) {
				$a=2;
			}
			return pow($b,1/$a);
		}
		public function findAndCalculateTerm(ICalculator $calculator) {
		    return (new einfacheOperation())->findAndCalculateTerm($calculator, $this);
		}
	}
?>
