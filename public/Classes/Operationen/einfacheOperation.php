<?php
namespace Taschenrechner\Classes\Operationen;

class einfacheOperation
{
    public function findAndCalculateTerm($calculator, $operationObject) {
        
        //arbeitet intern mit dem Array
        $array = $calculator->getTermArray();
        
        for($i =0; $i < sizeof($array)-1; $i++) {
            //Suche nach der Operation
            if($array[$i]===$operationObject->getSign()) {
                $a= array_key_exists($i-1,$array) ? $array[$i-1]:NULL;
                $b= array_key_exists($i+1,$array) ? $array[$i+1]:NULL;
                
                if(!is_numeric($array[$i+1])) {
                    throw new \Exception("Bitte einen gültigen Term eingeben");
                }
                //Berechne die Operation
                $array[$i-1] = $operationObject->calculate($a, $b);
                
                //Lösche die Operation und den 2. Term vom Array
                unset($array[$i]);
                unset($array[$i+1]);
                $array = array_values($array);
                
                return $array;
                
            }
            
        }
        return $array;
        
    }
}

