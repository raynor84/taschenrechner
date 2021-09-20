<?php
	namespace Taschenrechner\Classes;

	class Multiplikation extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "*";
		}	
		
		public function calculate($a, $b=NULL) {
			return $a*$b;
		}
	}
?>
