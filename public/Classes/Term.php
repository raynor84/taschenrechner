<?php

    namespace Taschenrechner\Classes;

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
			if(sizeof($this->array)==1) {
				if(!is_numeric($this->array[0])) {
					throw new \Exception("Bitte geben Sie einen gültigen Term ein!");
				}
			}
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
						$this->array= preg_split('/(?<!^)(?!$)/u', $this->term );;
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
					
					if(($this->operationen[$i]["reversepriority"]>$max_priority)&&(strcmp($this->array[$s], $this->operationen[$i]["object"]->getSign())==0)) {
						$max_priority = $this->operationen[$i]["reversepriority"];
						$priority = $this->operationen[$i]["object"];
						
					}
				}
			}
			
			return $priority;
		}	
	}
?>
