<?php
	require_once("operation.php");
	class Potenz extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "^";
		}	
		
		public function calculate($a, $b=NULL) {
			return pow($a,$b);
		}
	}
?>
