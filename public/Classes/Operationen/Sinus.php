<?php

namespace Taschenrechner\Classes\Operationen;
class Sinus extends Operation {
    public function getSign() {
        return "sin(";
    }

    public function calculate($a, $b=NULL) {
        return sin(deg2rad($a));
    }

    public function findAndCalculateTerm($term) {
            //arbeitet intern mit dem Array
			$array = preg_split('/(?<!^)(?!$)/u', $term );
		   	
			//füge alle darauf folgenden nummerischen werte zusammen
			$array = $this->numeric->concatinateNumericValues($array);
            for($i =0; $i < sizeof($array)-1; $i++) {
                if($array[$i]=="sin(") {
                    $array[$i] = $this->calculate($array[1]);
                    unset($array[$i+1]);
                    unset($array[$i+2]);
    
                }
            }
            return implode("", $array);
    }
} 