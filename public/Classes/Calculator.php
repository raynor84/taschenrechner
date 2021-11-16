<?php
namespace Taschenrechner\Classes;
    use Taschenrechner\Classes\Operationen\Operation;
class Calculator {
	private $operationen = array();
    public function addOperation(int $reversepriority, Operation $operation) {
        array_push($this->operationen, array("reversepriority" => $reversepriority, "object"=> $operation));
    }
	public function calculate($term=0) {
		
    	if(empty($this->operationen)) {
        	throw new \Exception("Keine Operationen für den Taschenrechner vorhanden");
    	}

		$termobject = new Term($term, $this->operationen, new Numeric());
		//Wenn der Term nicht gültig ist schmeiße nen Fehler
		if(!$termobject->verify()) {
			throw new \Exception("Bitte einen gültigen Term eingeben");		
		}
		
		//Löse den Term auf und gebe das Ergebnis zurück
		$ergebnis = $termobject->resolve();
		return $ergebnis;
	}
}
