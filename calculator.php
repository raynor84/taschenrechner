<?php
require_once("term.php");
class Calculator {
	private $operationen;

	public function calculate($term=0) {
		//Deklariere einen Term und übergebe den Term
		$this->operationen = array();
		$this->operationen[] = array(
											"object"=>new Klammer(),
											"priority"=>4,
											);
		$this->operationen[] = array(
								"object"=>new KlammerZu(),
								"priority"=> 4,
								);
		$this->operationen[] = array(
									"object"=>new Wurzel(),
									"priority"=>3,
									);
		$this->operationen[] = array(
									"object"=>new Potenz(),
									"priority"=>3,
									);
		$this->operationen[] = array(
									"object"=>new Multiplikation(),
									"priority"=>2,
									);
		$this->operationen[] = array(
									"object"=>new Division(),
									"priority"=>2,
									);
								
		$this->operationen[] = array(
									"object" =>new Addition(),
									"priority" => 1,
									);				
		$this->operationen[] = array(
									"object" =>new Subtraktion(),
									"priority" => 1,
									);

		$termobject = new Term($term, $this->operationen);
		//Wenn der Term nicht gültig ist schmeiße nen Fehler
		if(!$termobject->verify()) {
			throw new Exception("Bitte einen gültigen Term eingeben ");		
		}
		
		//Löse den Term auf und gebe das Ergebnis zurück
		$ergebnis = $termobject->resolve();
		return $ergebnis;
	}
}
