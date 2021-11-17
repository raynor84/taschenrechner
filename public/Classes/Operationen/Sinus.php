<?php

namespace Taschenrechner\Classes\Operationen;
class Sinus extends Operation {
    public function getSign() {
        return "sin";
    }

    public function calculate($a, $b=NULL) {
        return sin($a);
    }

    public function findAndCalculateTerm($term) {
            //arbeitet intern mit dem Array
			$array = preg_split('/(?<!^)(?!$)/u', $term );
		   	
			//füge alle darauf folgenden nummerischen werte zusammen
			$array = $this->numeric->concatinateNumericValues($array);
            $array[0] = $this->calculate(2);
            unset($array[1]);
            unset($array[2]);

            return implode("", $array);
    }
} 