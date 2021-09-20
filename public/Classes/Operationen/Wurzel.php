<?php
    namespace Taschenrechner\Classes\Operationen;
    
	class Wurzel extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "√";
		}	
		
		public function calculate($a, $b=NULL) {
			if($a==NULL) {
				$a=$b;
				$b=2;
			}
			return pow($a,1/$b);
		}
	}
?>
