<?php
	class Numeric {
		public static function concatinateNumericValues($array) {
			//Durchsuche das Array nach dem Vorhandensein eines numerischen Wert
			for($i=0; $i<sizeof($array); $i++) {
				//Findet den ersten Numerischen Wert(auch negative)
				if(is_numeric($array[$i])
					||self::is_negative($array, $i)
					){
					if(array_key_exists($i-1, $array)
						&&($array[$i-1]=="-")
						&&($array[$i]=="-")
						&&(array_key_exists($i+1, $array))
						&&(is_numeric($array[$i+1]))
						&&(!array_key_exists($i-2, $array))
						) {
							unset($array[$i-1]);
							unset($array[$i]);
							$array = array_values($array);
							$i-2;
						}
						
					//Wenn Gefunden dann überprüfe ob darauf folgende Werte im Array auch numerisch
					//sind und Füge diese Zusammen.
					for($s=1; ($s+$i)<sizeof($array); $s++) {
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
		
		private static function is_negative($array, $i) {
		 return (($array[$i]=="-")
					&&(array_key_exists($i-1, $array))
					&&(!is_numeric($array[$i-1])))
					||(($array[$i]=="-")
					&&(!array_key_exists($i-1, $array))
					);	
		}
	}
	
?>
