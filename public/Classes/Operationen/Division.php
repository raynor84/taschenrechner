<?php
	namespace Taschenrechner\Classes\Operationen;

	class Division extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "/";
		}	
		
		public function calculate($a, $b=NULL) {
			//Berechne die Operation
			if(empty($b))
				throw new \Exception("Division by Zero");
			return floatval($a) / floatval($b);
	
		}	
	}
?>
