<?php
require_once("term.php");
class Calculator {
	private $operationen;

	public function calculate($term=0) {
		//Deklariere einen Term und übergebe den Term
		$this->operationen = array();
		$this->operationen[] = array(
								"object"=>new Klammer(new Calculator(), new Numeric()),
								"priority"=>4,
								);
		$this->operationen[] = array(
								"object"=>new KlammerZu(new Calculator(), new Numeric()),
								"priority"=> 4,
								);
		$this->operationen[] = array(
								"object"=>new Wurzel(new Calculator(), new Numeric()),
								"priority"=>3,
								);
		$this->operationen[] = array(
								"object"=>new Potenz(new Calculator(), new Numeric()),
								"priority"=>3,
								);
		$this->operationen[] = array(
								"object"=>new Multiplikation(new Calculator(), new Numeric()),
								"priority"=>2,
								);
		$this->operationen[] = array(
								"object"=>new Division(new Calculator(), new Numeric()),
								"priority"=>2,
								);
								
		$this->operationen[] = array(
								"object" =>new Addition(new Calculator(), new Numeric()),
								"priority" => 1,
								);				
		$this->operationen[] = array(
								"object" =>new Subtraktion(new Calculator(), new Numeric()),
								"priority" => 1,
								);

		$termobject = new Term($term, $this->operationen, new Numeric());
		//Wenn der Term nicht gültig ist schmeiße nen Fehler
		if(!$termobject->verify()) {
			throw new Exception("Bitte einen gültigen Term eingeben ");		
		}
		
		//Löse den Term auf und gebe das Ergebnis zurück
		$ergebnis = $termobject->resolve();
		return $ergebnis;
	}
}
