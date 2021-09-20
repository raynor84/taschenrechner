<?php
    namespace Taschenrechner\Classes\Operationen;
	class Addition extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "+";
		}	
		
		public function calculate($a,$b=NULL) {
			//Berechne die Operation
			//return floatval(str_replace(',', '.', str_replace('.', '', $a))) + floatval(str_replace(',', '.', str_replace('.', '', $b)));
			
			return floatval($a)+floatval($b);
		}
	}
?>
