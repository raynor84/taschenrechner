<?php
    namespace Taschenrechner\Classes\Operationen;
	
	class Subtraktion extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "-";
		}	
		
		public function calculate($a, $b=NULL) {
			//Berechne die Operation
			return $a - $b;
	
		}
	}
?>