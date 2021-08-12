<?php

require_once("addition.php");
require_once("multiplikation.php");
require_once("division.php");
require_once("subtraktion.php");
require_once("klammer.php");
require_once("klammerzu.php");
require_once("potenz.php");
require_once("wurzel.php");

	class Term {
		private $array;
		private $term;
		private $numeric;
		private $operationen;
		public function __construct(String $term, Array $operationen, $numeric) {
				//Initialisiere alle möglichen Operationen und speichere Sie im Attribut Operationen
				$this->operationen = $operationen;
				$this->term = $term;
				$this->numeric = $numeric;
				//Array mit dem intern gearbeitet wird
				//statt str_split
				$this->array =preg_split('/(?<!^)(?!$)/u', $term );
		}
		
		
		//Überprüfe ob der Term gültig ist.	
		public function verify() {
			
			for($i=0; $i<sizeof($this->array); $i++) {
				$bool = 0;
				for($s = 0; $s<sizeof($this->operationen);$s++) {
					//Überprüft ob der Wert keines der gültigen Werte besitzt, bsp. ist nich numerisch und hat auch
					//nicht die nötigen Operationen
					if((strcmp($this->array[$i], $this->operationen[$s]["object"]->getSign())!=0)&&(!is_numeric($this->array[$i]))
						&&($this->array[$i]!=",")&&($this->array[$i]!=".")) {
						$bool++;
					}
					for($t=1; $t<sizeof($this->operationen);$t++) {
						if($this->operationen[$t]["object"]->getSign() == "-") {
							continue;
						}
						
						if((strcmp($this->array[$i], $this->operationen[$s]["object"]->getSign())==0)
							&&(array_key_exists($i+1, $this->array))
							&&(strcmp($this->array[$i+1], $this->operationen[$t]["object"]->getSign())==0)
							&&($this->array[$i] != ")")
							&&($this->array[$i+1]!="(")
							) {
								
								return false;
							}
						
					}
				
				}
				
				//Überprüft das logische UND der Operationen
				if($bool >= sizeof($this->operationen)) {
					return false;							
				} else {
					$bool=0;				
				}
				
			}
			return true;
		}
		
		
		/*Löse den Term auf */
		public function resolve() {

			while(sizeof($this->array)>1) {
					
					$object = $this->getPriorityOperation();
					
					if($object != NULL) {

						$this->term = $object->findAndCalculateTerm($this->term);
						$this->array= str_split($this->term);
						$this->array = $this->numeric->concatinateNumericValues($this->array);
						$this->term = implode("", $this->array);

					} else {
						break;
					}
			}
				
			return $this->term;
		}
		
			private function getPriorityOperation() {
			
			$max_priority = -1;
			$priority = NULL;
			for($s=0;$s<sizeof($this->array);$s++) {
				for($i=0; $i<sizeof($this->operationen);$i++) {
					
					if(($this->operationen[$i]["priority"]>$max_priority)&&(strcmp($this->array[$s], $this->operationen[$i]["object"]->getSign())==0)) {
						$max_priority = $this->operationen[$i]["priority"];
						$priority = $this->operationen[$i]["object"];
						
					}
				}
			}
			
			return $priority;
		}	
	}
?>
