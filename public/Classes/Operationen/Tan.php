<?php

namespace Taschenrechner\Classes\Operationen;
use Taschenrechner\Classes\ICalculator;
class Tan extends Operation {
    public function getSign() {
        return "tan(";
    }

    public function calculate($a, $b=NULL) {
        return tan(deg2rad($a));
    }

    public function findAndCalculateTerm(ICalculator $calculator) {
            //arbeitet intern mit dem Array
            $array = $calculator->getTermArray();
		   	
            for($i = 0; $i < sizeof($array); $i++) {
                if($array[$i]==$this->getSign()) {
                    $array[$i] = (String) $this->calculate($array[$i+1]);
                    unset($array[$i+1]);
                    unset($array[$i+2]);
                    $array = array_values($array);
                }
            }
            return $array;
    }
}