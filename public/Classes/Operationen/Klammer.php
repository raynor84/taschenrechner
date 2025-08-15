<?php
	namespace Taschenrechner\Classes\Operationen;
    use Taschenrechner\Classes\Calculator;
    use Taschenrechner\Classes\Concatinator;
    use Taschenrechner\Classes\ICalculator;
	class Klammer extends Operation {
		//Gibt das Zeichen für die Operation zurück
		public function getSign() {
			return "(";
		}	
		public function calculate($a, $b=NULL) {
			return NULL;
		}
		public function findAndCalculateTerm(ICalculator $calculator) {

		    $array = $calculator->getTermArray();
			//Sucht nach einer Klammer
			$klammer_zu_gefunden = false;	
			$getLastParanthese = false;
			$klammer_auf = -1;
			$klammer_zu = -1;
			$term2="";
			
			for($i =0; $i< sizeof($array); $i++) {
			
				//Wenn die Klammer gefunden wurde, dann speichere die Klammer
				//und suche nach der schließenden Klammer
				if($array[$i] == $this->getSign()) {
					$klammer_auf = $i;
					if($i==0) {
					}else if(is_numeric($array[$i-1])) {
						throw new \Exception("Bitte einen gültigen Term eingeben");
					}
					for($s = $i+1; $s < sizeof($array); $s++) {
						if($array[$s]==$this->getSign()) {
							$getLastParanthese=true;
						}
						if($array[$s]==")") {
							$klammer_zu = $s;
							$klammer_zu_gefunden=true;	
							if($getLastParanthese==false) {
								break;
							}
						}
					}
					if($klammer_zu_gefunden == false) {
						throw new \Exception("Es fehlt eine schließende Klammer");
					}
					//Speichere den internen Ausdruck in einen Term
					for($s=$klammer_auf+1; $s < $klammer_zu; $s++) {
						$term2.=$array[$s];					
					}
					//Erzeuge einen neuen Term
					
					
					//Lösche die öffnende und schließende Klammer 
					for($i=$klammer_auf+1; $i<=$klammer_zu; $i++) {
						unset($array[$i]);
					}
					//gebe das Ergebnis
					//zurück
					$array[$klammer_auf] = $this->calculator->calculate($term2);
					$array = array_values($array);

					return $array;
					
				}

			}
			return $array;
		}
	}
?>