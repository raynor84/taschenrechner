<?php
require_once("term.php");
class Calculator {
	public function calculate($term=0) {
		//Deklariere einen Term und übergebe den Term
		$termobject = new Term($term);
		//Wenn der Term nicht gültig ist schmeiße nen Fehler
		if(!$termobject->verify()) {
			throw new Exception("Bitte einen gültigen Term eingeben ");		
		}
		
		//Löse den Term auf und gebe das Ergebnis zurück
		$ergebnis = $termobject->resolve();
		return $ergebnis;
	}
}
