<?php
    namespace Taschenrechner\Classes;

	class Concatinator {
		public function concatinateArray($array) {
			$array = $this->concatinateOperations($array);
			$array = $this->concatinateNumericValues($array);
			return $array;
		}
		public function concatinateNumericValues($array) {
			//Durchsuche das Array nach dem Vorhandensein eines numerischen Wert
			for($i=0; $i<sizeof($array); $i++) {
				//Findet den ersten Numerischen Wert(auch negative)
				if((is_numeric($array[$i])
					|| ($this->is_negative($array, $i))
					|| ($this->is_positive($array, $i))
					)){
    					if($this->isNumberWithTwoNegatives($array, $i)||($this->isNumberwithTwoPositives($array, $i))) {
							unset($array[$i]); //unset second operation
							unset($array[$i-1]); //unset first operation
							$array = array_values($array);
    						if($i>0)  
                                $i--;
                            else
                                $i=0;

						}
						if($this->is_positive($array, $i)) {
							unset($array[$i]);
							$array = array_values($array);
						}

    					//Wenn Gefunden dann überprüfe ob darauf folgende Werte im Array auch numerisch
    					//sind und Füge diese Zusammen.
    					for($s=1; ($s+$i)<sizeof($array); $s++) {
        					if(!array_key_exists($s+$i, $array)) {
            					break;
        					}
							if($this->isNumericOrKomma($array[$i+$s])) {

    							$array[$i] .= $array[$i+$s];
    							//Lösche den Eintrag, da dieser mit dem vorherigen Zusammengeführt wurde
    							unset($array[$i+$s]);
    							
    							//Ordne das Array
    							$array = array_values($array);
    							$s--;
    						} else {
    						
    							break;						
    							
    						}						
    					}
				}			

			}
			return $array;
		}

		private function concatinateOperations($array) {
			
			if(($array[0]=="s")&&($array[1]=="i")&&($array[2]=="n")&&($array[3]=="(")) {
				$array[0]="sin(";
				unset($array[1]);
				unset($array[2]);
				unset($array[3]);
				$array = array_values($array);
			} 
			return $array;
		}
		
		private function is_negative($array, $i) {
		 return (($array[$i]=="-")
					&&(array_key_exists($i-1, $array))
					&&(!is_numeric($array[$i-1])))
					||(($array[$i]=="-")
					&&(!array_key_exists($i-1, $array))
					);	
		}
		private function is_positive($array, $i) {
			return (($array[$i]=="+")
					   && (!array_key_exists($i-1, $array))
					   && (array_key_exists($i+1, $array))
					   );	
		   }

		private function isNumberwithTwoPositives($array, $i) {
			if(array_key_exists($i-1, $array)
					&&($array[$i-1]=="+")
					&&($array[$i]=="+")
					&&(array_key_exists($i+1, $array))
					&&(is_numeric($array[$i+1]))
					&&(!array_key_exists($i-2, $array))
					) {
						return true;
			}
			return false;

		}
		private function isNumericOrKomma($value) {
			if(is_numeric($value)||($value==",")||($value==".")) {
				return true;
			}
			return false;
		}
		private function isNumberWithTwoNegatives($array, $i) {
			if(array_key_exists($i-1, $array)
				&&($array[$i-1]=="-")
				&&($array[$i]=="-")
				&&(array_key_exists($i+1, $array))
				&&(is_numeric($array[$i+1]))
				&&(!array_key_exists($i-2, $array))
				) {
    				return true;
                }
                return false;

		}
	}
	
?>