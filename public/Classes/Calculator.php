<?php
namespace Taschenrechner\Classes;
    use Taschenrechner\Classes\Operationen\Operation;

    
    class Calculator implements ICalculator {
	private $operationen = array();
	private $array;
	private $term;
	private $numeric;

	public function __construct() {
	    //Löse den Term auf und gebe das Ergebnis zurück
	    
	    $this->numeric = new Concatinator();
	    //Array mit dem intern gearbeitet wird
	    
	}
	public function addOperation(int $reversepriority, Operation $operation) {
	    array_push($this->operationen, array("reversepriority" => $reversepriority, "object"=> $operation));
	}
	public function calculate($term=0) {
	    
	    $this->term = $term;
	    
	    if(empty($this->operationen)) {
	        throw new \Exception("Keine Operationen für den Taschenrechner vorhanden");
	    }
	    
	    $termVerifierobject = new TermVerifier($this->operationen);
	    //Wenn der Term nicht gültig ist schmeiße nen Fehler
	    if(!$termVerifierobject->verify()) {
	        throw new \Exception("Bitte einen gültigen Term eingeben");
	    }

	    
	    $ergebnis = $this->resolve();
	    return $ergebnis;
	}
	
	
	/*Löse den Term auf */
	private function resolve() {
	    $this->array =preg_split('/(?<!^)(?!$)/u', $this->term );
	    
	    
	    while(sizeof($this->array)>1) {
	        
	        $this->array = $this->numeric->concatinateArray($this->array, $this->operationen);
	        
	        $object = $this->getPriorityOperation();
	        
	        if($object != NULL) {
	            $this->array = $object->findAndCalculateTerm($this->array, $this->operationen);
	            $this->term = implode("", $this->array);
	            $this->array = preg_split('/(?<!^)(?!$)/u', $this->term );
	            
	            
	        } else {
	            
	            break;
	        }
	    }
	    $this->array = $this->numeric->concatinateArray($this->array, $this->operationen);
	    
	    $this->term = implode("", $this->array);
	    return $this->term;
	}
	
	private function getPriorityOperation() {
	    
	    $max_priority = -1;
	    $priority = NULL;
	    for($operation_index=0;$operation_index<sizeof($this->array);$operation_index++) {
	        for($term_index=0; $term_index<sizeof($this->operationen);$term_index++) {
	            
	            if($this->checkMaybeRightOperation($term_index, $operation_index, $max_priority)) {
	                $max_priority = $this->operationen[$term_index]["reversepriority"];
	                $priority = $this->operationen[$term_index]["object"];
	                
	            }
	        }
	    }
	    
	    return $priority;
	}
	
	private function checkMaybeRightOperation($term_index, $operation_index, $max_priority) {
	    if(($this->operationen[$term_index]["reversepriority"]>$max_priority)
	        &&(strcmp($this->array[$operation_index], $this->operationen[$term_index]["object"]->getSign())==0)) {
	            return true;
	        }
	        return false;
	}
 
}
