<?php
	namespace Taschenrechner\Classes\Operationen;
	use Taschenrechner\Classes\ICalculator;
	
	class KlammerZu extends Operation {
		//KlammerZu beinhaltet als Operation eine schließende Klammer
		public function getSign() {
			return ")";
		}	
		
		//Tue nichts mit dem Term (wird bereits in Klammer) durchgeführt.
		public function findAndCalculateTerm(ICalculator $calculator) {
			return $term;
		}
		public function calculate($a, $b=NULL) {
			return NULL;
		}
	}
?>