<?php
    namespace Taschenrechner\Classes;

	class Numeric {
		public function concatinateNumericValues($array) {
			//Durchsuche das Array nach dem Vorhandensein eines numerischen Wert
			for($i=0; $i<sizeof($array); $i++) {
    			if(!array_key_exists($i, $array)) {break;}
				//Findet den ersten Numerischen Wert(auch negative)
				if((is_numeric($array[$i])
					|| ($this->is_negative($array, $i)))
					){
    					
    					if($this->isNumberWithTwoNegatives($array, $i)) {
							unset($array[$i]); //unset second minus
							unset($array[$i-1]); //unset first minus
							$array = array_values($array);
    						if($i>0)  
                                $i--;
                            else
                                $i=0;

						}
    					//Wenn Gefunden dann überprüfe ob darauf folgende Werte im Array auch numerisch
    					//sind und Füge diese Zusammen.
    					for($s=1; ($s+$i)<sizeof($array); $s++) {
        					if(!array_key_exists($s+$i, $array)) {
            					break;
        					}
    						if(is_numeric($array[$i+$s])||($array[$i+$s]==",")||($array[$i+$s]==".")) {
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
		
		private function is_negative($array, $i) {
		 return (($array[$i]=="-")
					&&(array_key_exists($i-1, $array))
					&&(!is_numeric($array[$i-1])))
					||(($array[$i]=="-")
					&&(!array_key_exists($i-1, $array))
					);	
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