<?php
	require_once("operation.php");
	require_once("numeric.php");
	class KlammerZu extends Operation {
		//KlammerZu beinhaltet als Operation eine schließende Klammer
		public function getSign() {
			return ")";
		}	
		
		//Tue nichts mit dem Term (wird bereits in Klammer) durchgeführt.
		public function findAndCalculate($term) {
			return $term;
		}
		public function calculate($a, $b=NULL) {
			return NULL;
		}
	}
?>