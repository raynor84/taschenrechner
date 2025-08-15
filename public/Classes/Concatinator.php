<?php
    namespace Taschenrechner\Classes;

	class Concatinator implements IConcatinator {
		public function concatinateArray($array, $operations) {
			$array = $this->concatinateNumericValues($array);
			$array = $this->concatinateOperations($array, $operations);
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
							if($array[$i+1]=="+") {
								unset($array[$i+1]);
							} 
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

		private function concatinateOperations($array, $operations) {
			
			foreach($operations as $operation) {
				if(strlen($operation["object"]->getSign())<4) continue;
				for($i=0; $i<sizeof($array);$i++) {
					if(!array_key_exists($i+strlen($operation["object"]->getSign())-1, $array))
						continue;
					if(($array[$i]==$operation["object"]->getSign()[0])
					&&($array[$i+1]==$operation["object"]->getSign()[1])
					&&($array[$i+2]==$operation["object"]->getSign()[2])
					&&($array[$i+3]==$operation["object"]->getSign()[3])) {
					$array[$i]=$operation["object"]->getSign();
					
					unset($array[$i+1]);
					unset($array[$i+2]);
					unset($array[$i+3]);
					
					$array = array_values($array);
					break 2;
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
