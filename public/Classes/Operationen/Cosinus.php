<?php

namespace Taschenrechner\Classes\Operationen;
class Cosinus extends Operation {
    public function getSign() {
        return "cos(";
    }

    public function calculate($a, $b=NULL) {
        return cos(deg2rad($a));
    }

    public function findAndCalculateTerm($split_term, $operations) {
            //arbeitet intern mit dem Array
			$array = $split_term;
		   	
            for($i =0; $i < sizeof($array)-1; $i++) {
                if($array[$i]=="cos(") {
                    $array[$i] = $this->calculate($array[$i+1]);
                    unset($array[$i+1]);
                    unset($array[$i+2]);
                    $array = array_values($array);
                }
            }
            return $array;
    }
}