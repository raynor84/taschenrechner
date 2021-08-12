<?php
	//Abstrakte Klasse Operation
	abstract class Operation {
		//Gibt Operanten zurück
		abstract public function getSign();
		//Berechnet den Term und gibt den neuen Term zurück
		abstract public function calculate($a, $b=NULL);
		public function findAndCalculateTerm($term) {
			
			//arbeitet intern mit dem Array
			$array = preg_split('/(?<!^)(?!$)/u', $term );
		   	
			//füge alle darauf folgenden nummerischen werte zusammen
			$array = Numeric::concatinateNumericValues($array);
			
			for($i =0; $i < sizeof($array)-1; $i++) {

				//Suche nach der Operation
				if(strcmp($array[$i], $this->getSign())==0) {
					$a= array_key_exists($i-1,$array) ? $array[$i-1]:NULL;
					$b= array_key_exists($i+1,$array) ? $array[$i+1]:NULL;
					
					if(!is_numeric($array[$i+1])) {
						throw new Exception("Bitte einen gültigen Term eingeben");
					}
					//Berechne die Operation
					$array[$i-1] = $this->calculate($a, $b);
					
					//Lösche die Operation und den 2. Term vom Array
					unset($array[$i]);
					unset($array[$i+1]);
					$array = array_values($array);
					//var_dump($array);
					//Füge den Term wieder zusammen
					$term = implode("", $array);
					
					return $term;
					
				}

			}
			if(sizeof($array)>0)
				$term = implode("", $array);
			else 
				$term = "";
			return $term;
		}
	}
?>
