<?php

namespace Taschenrechner\Classes\Operationen;
class Sinus extends Operation {
    public function getSign() {
        return "sin(";
    }

    public function calculate($a, $b=NULL) {
        return sin(deg2rad($a));
    }

    public function findAndCalculateTerm($split_term, $operations) {
            //arbeitet intern mit dem Array
			$array = $split_term;
		   	            
            for($i = 0; $i < sizeof($array); $i++) {
                if($array[$i]===$this->getSign()) {
                    $array[$i] = $this->calculate($array[$i+1]);
                    unset($array[$i+1]);
                    unset($array[$i+2]);
                    $array = array_values($array);
                }
            }
            return $array;
    }
}