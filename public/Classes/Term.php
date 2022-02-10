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
			
			$this->array= $this->numeric->concatinateArray($this->array, $this->operationen);

			if($this->sizeOneAndNotNumeric()) {
				return false;
			}
			for($term_index=0; $term_index<sizeof($this->array); $term_index++) {
				$bool = 0;
				for($operation_index = 0; $operation_index<sizeof($this->operationen);$operation_index++) {
					if($this->isNotNumericOrKommaOrOperand($term_index, $operation_index)) {
						$bool++;
					}
					for($operation_index2=1; $operation_index2<sizeof($this->operationen);$operation_index2++) {
						if($this->operationen[$operation_index2]["object"]->getSign() == "-"
						|| $this->operationen[$operation_index2]["object"]->getSign() == "+") {
							continue;
						}

						if($this->isTwoConsecutiveOperandAndNotParanthese($operation_index, $term_index, $operation_index2)) {
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
		private function sizeOneAndNotNumeric() {
			if(sizeof($this->array)==1) {
				if(!is_numeric($this->array[0])) {
					return true;
				}
			}
			return false;

		}
		private function isNotNumericOrKommaOrOperand($term_index, $operation_index) {
			if((strcmp($this->array[$term_index], $this->operationen[$operation_index]["object"]->getSign())!=0)&&(!is_numeric($this->array[$term_index]))
			&&($this->array[$term_index]!=",")&&($this->array[$term_index]!=".")) {
				return true;
			}
			return false;
		}

		private function isTwoConsecutiveOperandAndNotParanthese($operation_index, $term_index, $operation_index2) {
			if((strcmp($this->array[$term_index], $this->operationen[$operation_index]["object"]->getSign())==0)
			&&(array_key_exists($term_index+1, $this->array))
			&&(strcmp($this->array[$term_index+1], $this->operationen[$operation_index2]["object"]->getSign())==0)
			&&($this->array[$term_index] != ")")
			&&($this->array[$term_index+1]!="(")
			) {
				
				return false;
			}

		}
		/*Löse den Term auf */
		public function resolve() {
			$this->array =preg_split('/(?<!^)(?!$)/u', $this->term );


			while(sizeof($this->array)>1) {
					
					$this->array = $this->numeric->concatinateArray($this->array, $this->operationen);
					$this->term = implode("", $this->array);

					$object = $this->getPriorityOperation();
			
					if($object != NULL) {
						$this->array = $object->findAndCalculateTerm($this->term, $this->operationen);
						
					} else {

						break;
					}
			}
			
			$this->term = implode("", $this->array);
			return $this->term;
		}
		
			private function getPriorityOperation() {
			
			$max_priority = -1;
			$priority = NULL;
			for($operation_index=0;$operation_index<sizeof($this->array);$operation_index++) {
				for($term_index=0; $term_index<sizeof($this->operationen);$term_index++) {
					
					if(($this->operationen[$term_index]["reversepriority"]>$max_priority)&&(strcmp($this->array[$operation_index], $this->operationen[$term_index]["object"]->getSign())==0)) {
						$max_priority = $this->operationen[$term_index]["reversepriority"];
						$priority = $this->operationen[$term_index]["object"];
						
					}
				}
			}
			
			return $priority;
		}	
	}
?>
