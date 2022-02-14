<?php
    namespace Taschenrechner\Classes\Operationen;
	
	class Addition extends Operation {
		public function getSign() {
			return "+";
		}	
		
		public function calculate($a,$b=NULL) {
			return $a + $b;
		}
	}
?>
